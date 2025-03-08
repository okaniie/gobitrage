<?php

namespace App\Http\Controllers\Admin;

use App\Events\SettingsChangedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SettingsController extends Controller
{
    public function index()
    {
        return view('pages.admin.settings', [
            'settings' => [
                'min_withdrawal' => Setting::get('min_withdrawal'),
                'pay_referral' => Setting::get('pay_referral'),
                'google_track_id' => Setting::get('google_track_id'),
                'header_code' => Setting::get('header_code'),
                'footer_code' => Setting::get('footer_code'),
            ]
        ]);
    }

    public function update(SettingsRequest $request)
    {
        $validated = $request->validated();


        if (!Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $validated['password'],
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        };

        unset($validated['password']);

        foreach ($validated as $key => $value) Setting::set($key, $value);

        SettingsChangedEvent::dispatch();

        return back()->with('success', "Settings updated successfully.");
    }

    public function autowithdrawal()
    {
        return view('pages.admin.auto-withdrawal', [
            'site_auto_withdrawal_max' => Setting::get('site_auto_withdrawal_max'),
            'site_auto_withdrawal' => Setting::get('site_auto_withdrawal')
        ]);
    }

    public function autowithdrawalUpdate(Request $request)
    {

        foreach ($request->all() as $key => $value) {
            Setting::set($key, $value);
        }

        return back()->with("success", "Record updated successfully.");
    }
}
