<?php

namespace App\Listeners;

use App\Events\ReferralBonusPaid;
use App\Mail\AdminEmail;
use App\Mail\UserEmail;
use App\Models\EmailTemplate;
use App\Traits\UserEmailsTrait;
use Illuminate\Support\Facades\Mail;

class ReferralBonusNotification
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
     * @param  \App\Events\ReferralBonusPaid  $event
     * @return void
     */
    public function handle(ReferralBonusPaid $event)
    {
        /**
         * @var \App\Models\User
         */
        $user = $event->referral->user()->first();

        // get the email template
        $template = EmailTemplate::where('code', $this->userReferralBonusEmailId)->get()->first();
        $adminTemplate = EmailTemplate::where('code', $this->adminReferralBonusEmailId)->get()->first();

        if (!$template) return;

        // run replacements
        $replacements = array_merge($event->referral->toArray(), $user->toArray(), ['amount' => $event->amount]);

        //send mail to user
        Mail::to($user)->queue(new UserEmail($template, $replacements));
        //send mail to admin
        Mail::queue(new AdminEmail($adminTemplate, $replacements));
    }
}
