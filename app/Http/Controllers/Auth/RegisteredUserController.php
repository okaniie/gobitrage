<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Referral;
use App\Models\User;
use App\Models\Wallet;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignUpMail;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'username' => 'nullable|string',
            'secret_question' => 'nullable|string',
            'secret_answer' => 'nullable|string',
            'wallets' => 'nullable'
        ]);

        if (empty($request->username)) $request->username = strtolower(str_replace(" ", "-", $request->name) . "-" . rand(0, 999999));

        if (User::first()) {
            $refId = session('ref', 1);
            $referrer = User::find($refId);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'user_type' => empty(User::first()) ? "admin" : "user",
            'secret_question' => $request->secret_question ?? "",
            'secret_answer' => $request->secret_answer ?? "",
        ]);

        
        if ($user->email != null) {
            try {
                Mail::to($user->email)->send(new SignUpMail($user));
            } catch (\Exception $e) {
                // Handle the exception if needed
            }
        }
        

        if (!empty($request->wallets)) {
            foreach ($request->wallets as $currency_code => $address) {
                if (empty($address)) continue;

                $currency = Currency::where('code', $currency_code)->get()->first();

                Wallet::create([
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'currency_id' => $currency->id,
                    'currency_code' => $currency->code,
                    'deposit_address' => $address,
                ]);
            }
        }

        Auth::login($user);

        if (!empty($referrer)) {
            Referral::create([
                'referral_user_id' => $referrer->id,
                'referral_username' => $referrer->username,
                'referred_user_id' => $user->id,
                'referred_username' => $user->username,
            ]);
        }

        event(new Registered($user));

        if ($user->user_type == "admin") {
            return redirect(route('admin.dashboard'));
        }

        return redirect(route('user.dashboard'));
    }
}
