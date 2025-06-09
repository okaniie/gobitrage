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

        $formType = $request->input('form_type');

    if ($formType === 'profile') {
        $validated = $request->validate([
            'profile.email' => 'required|email',
            'profile.name' => 'nullable|string|max:255',
            // 'profile.phone' => 'nullable|string|max:20',
            // 'profile.address' => 'nullable|string|max:255',
            'password.password' => 'nullable|string|min:6',
            'password.confirmPassword' => 'nullable|same:password.password',
        ]);

        $data = $validated['profile'];

        if (!empty($validated['password']['password'])) {
            $data['password'] = bcrypt($validated['password']['password']);
        }
        dd($data);

        $user->update($data);
        return back()->with('success', 'Profile updated successfully.');
    }

        if ($formType === 'wallets') {
        $validated = $request->validate([
            'deposit_address' => 'array',
            'deposit_address.*' => 'nullable|string|min:26|max:100',
        ]);

        $wallets = $validated['deposit_address'] ?? [];

        foreach ($wallets as $code => $address) {
            $user->wallets()->updateOrCreate(
                ['currency_code' => $code],
                ['deposit_address' => $address]
            );
        }

        return back()->with('success', 'Wallets updated successfully.');
    }

    return back()->with('error', 'Invalid form submission.');
    }

}
