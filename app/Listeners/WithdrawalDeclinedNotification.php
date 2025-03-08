<?php

namespace App\Listeners;

use App\Events\WithdrawalDeclined;
use App\Mail\AdminEmail;
use App\Mail\UserEmail;
use App\Models\EmailTemplate;
use App\Traits\UserEmailsTrait;
use Illuminate\Support\Facades\Mail;

class WithdrawalDeclinedNotification
{
    use UserEmailsTrait;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\WithdrawalDeclined  $event
     * @return void
     */
    public function handle(WithdrawalDeclined $event)
    {
        /**
         * @var \App\Models\User
         */
        $user = $event->withdrawal->user()->first();

        // get the email template
        $template = EmailTemplate::where('code', $this->userWithdrawalDeclinedEmailId)->get()->first();
        $adminTemplate = EmailTemplate::where('code', $this->adminWithdrawalDeclinedEmailId)->get()->first();

        if (!$template) return;

        // run replacements
        $replacements = array_merge($event->withdrawal->toArray(), $user->toArray());

        //send mail to user
        Mail::to($user)->queue(new UserEmail($template, $replacements));
        //send mail to admin
        Mail::queue(new AdminEmail($adminTemplate, $replacements));
    }
}
