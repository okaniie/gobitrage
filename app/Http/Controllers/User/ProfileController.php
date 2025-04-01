<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $addresses = [];
        $currencies = Currency::where('status', '1')->get()->all();

        foreach ($currencies as $currency) {

            $address = new \stdClass;

            $address->display_name = $currency->display_name;
            $address->currency_code = $currency->code;
            $address->deposit_address = "";

            $wallet = Wallet::whereBelongsTo($request->user())
                ->where('currency_id', $currency->id)->get()->first();

            if ($wallet) $address->deposit_address = $wallet->deposit_address;

            $addresses[] = $address;
        }

        return view('pages.user.profile', [
            'user' => $request->user(),
            'addresses' => $addresses
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'profile.email' => 'required|string|email',
            'profile.name' => 'nullable|string',
            'deposit_address.*' => 'nullable|string|min:26|max:100'
        ]);

        $profile = $request->profile;
        $addresses = $request->deposit_address;
        $passwords = $request->password;

        // update addresses
        $errors = [];
        $success = false;
        $updatedWallets = [];

        // First validate all addresses
        foreach ($addresses as $code => $address) {
            try {
                if (empty($address)) {
                    continue;
                }

                // Basic validation for wallet addresses
                if (!preg_match('/^[a-zA-Z0-9]+$/', $address)) {
                    $errors[] = "Invalid characters in {$code} address";
                    continue;
                }

                // Check wallet address length
                if (strlen($address) < 26 || strlen($address) > 100) {
                    $errors[] = "Invalid length for {$code} address";
                    continue;
                }

                // Get currency and validate address format
                $currency = Currency::where('code', $code)->get()->first();

                if (!$currency) {
                    $errors[] = "Invalid currency code: {$code}";
                    continue;
                }

                // Check if address is already in use by another user
                $existingWallet = Wallet::where('deposit_address', $address)
                    ->where('user_id', '!=', $user->id)
                    ->first();

                if ($existingWallet) {
                    $errors[] = "{$code} address is already in use by another user";
                    continue;
                }

                // Currency-specific validation
                switch ($code) {
                    case 'BTC':
                        if (!preg_match('/^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$/', $address)) {
                            $errors[] = "Invalid BTC address format";
                            break;
                        }
                        break;
                    case 'ETH':
                        if (!preg_match('/^0x[a-fA-F0-9]{40}$/', $address)) {
                            $errors[] = "Invalid ETH address format";
                            break;
                        }
                        break;
                    case 'USDT':
                        if (!preg_match('/^T[a-zA-Z0-9]{33}$/', $address)) {
                            $errors[] = "Invalid USDT address format";
                            break;
                        }
                        break;
                    default:
                        // For other currencies, just use basic validation
                        break;
                }

                // If we got here, validation passed
                if (!isset($errors[count($errors) - 1]) || !str_contains($errors[count($errors) - 1], $code)) {
                    // If all validation passes, add to updatedWallets array
                    $updatedWallets[$code] = [
                        'address' => $address,
                        'currency' => $currency
                    ];
                }
            } catch (\Exception $e) {
                \Log::error('Failed to validate wallet: ' . $e->getMessage());
                $errors[] = "Failed to validate {$code} wallet: " . $e->getMessage();
                continue;
            }
        }

        // If there are validation errors, return early
        if (!empty($errors)) {
            return back()->with('error', implode(', ', $errors));
        }

        // Now update all wallets in a transaction
        try {
            DB::beginTransaction();

            // Update profile first
            if (!$user->update([
                'email' => $profile['email'],
                'name' => $profile['name']
            ])) {
                throw new \Exception("Failed to update profile information");
            }
            $success = true;

            foreach ($updatedWallets as $code => $data) {
                $wallet = Wallet::whereBelongsTo($user)
                    ->where('currency_code', $code)
                    ->first();

                if (!empty($wallet)) {
                    if (!$wallet->update(['deposit_address' => $data['address']])) {
                        throw new \Exception("Failed to update {$code} wallet");
                    }
                } else {
                    if (!Wallet::create([
                        'user_id' => $user->id,
                        'username' => $user->username,
                        'currency_id' => $data['currency']->id,
                        'currency_code' => $data['currency']->code,
                        'deposit_address' => $data['address']
                    ])) {
                        throw new \Exception("Failed to create {$code} wallet");
                    }
                }
                $success = true;
            }

            // Update password if needed
            if (!empty($passwords['password'])) {
                if ($passwords['password'] !== $passwords['confirmPassword']) {
                    throw new \Exception("New password not set. Passwords do not match.");
                }

                if (!$user->forceFill([
                    'password' => Hash::make($passwords['password']),
                ])->save()) {
                    throw new \Exception("Failed to update password");
                }
                $success = true;
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Failed to update profile: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }

        if (!$success) {
            return back()->with('error', 'No changes were made');
        }

        return back()->with('success', 'Profile updated successfully!');
    }
}
