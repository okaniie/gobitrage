<?php

namespace App\Traits;

use App\Mail\AdminEmail;
use App\Mail\UserEmail;
use App\Models\EmailTemplate;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

trait EmailNotificationTrait
{
    protected function sendDepositNotification($deposit, $user)
    {
        // Get email templates
        $userTemplate = EmailTemplate::where('code', 'deposit--user')->first();
        $adminTemplate = EmailTemplate::where('code', 'deposit--admin')->first();

        if (!$userTemplate || !$adminTemplate) return;

        // Prepare replacements
        $replacements = array_merge($user->toArray(), [
            'amount' => $deposit->amount,
            'currency' => $deposit->crypto_currency,
            'plan' => $deposit->plan_title,
            'transaction_id' => $deposit->transaction_id,
        ]);

        // Send to user
        Mail::to($user)->queue(new UserEmail($userTemplate, $replacements));
        
        // Send to admin
        Mail::queue(new AdminEmail($adminTemplate, $replacements));
    }

    protected function sendWithdrawalNotification($withdrawal, $user)
    {
        // Get email templates
        $userTemplate = EmailTemplate::where('code', 'withdrawal--user')->first();
        $adminTemplate = EmailTemplate::where('code', 'withdrawal--admin')->first();

        if (!$userTemplate || !$adminTemplate) return;

        // Prepare replacements
        $replacements = array_merge($user->toArray(), [
            'amount' => $withdrawal->amount,
            'currency' => $withdrawal->crypto_currency,
            'address' => $withdrawal->address,
            'transaction_id' => $withdrawal->transaction_id,
        ]);

        // Send to user
        Mail::to($user)->queue(new UserEmail($userTemplate, $replacements));
        
        // Send to admin
        Mail::queue(new AdminEmail($adminTemplate, $replacements));
    }
} 