<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'profile.name' => 'nullable|string'
        ]);

        $profile = $request->profile;
        $addresses = $request->deposit_address;
        $passwords = $request->password;

        // update profile
        $user->update(['email' => $profile['email'], 'name' => $profile['name']]);

        // update addresses
        foreach ($addresses as $code => $address) {
            $wallet = Wallet::whereBelongsTo($user)
                ->where('currency_code', $code)->get()->first();

            if (!empty($wallet)) {

                $wallet->update(['deposit_address' => $address]);
            } else {

                $currency = Currency::where('code', $code)->get()->first();

                Wallet::create([
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'currency_id' => $currency->id,
                    'currency_code' => $currency->code,
                ]);
            }
        }

        // set the new password
        if (!empty($passwords['password'])) {
            if ($passwords['password'] !== $passwords['confirmPassword']) {
                return back()->with("error", "New password not set. Other updates completed successfully.");
            }

            // updated
            $user->forceFill([
                'password' => Hash::make($passwords['password']),
            ])->save();
        }

        return back()->with('success', 'Profile updated successfully!');
    }
}
