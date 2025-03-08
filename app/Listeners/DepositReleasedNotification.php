<?php

namespace App\Listeners;

use App\Events\DepositReleased;
use App\Mail\AdminEmail;
use App\Mail\UserEmail;
use App\Models\EmailTemplate;
use App\Traits\UserEmailsTrait;
use Illuminate\Support\Facades\Mail;

class DepositReleasedNotification
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
     * @param  \App\Events\DepositReleased  $event
     * @return void
     */
    public function handle(DepositReleased $event)
    {
        /**
         * @var \App\Models\User
         */
        $user = $event->deposit->user()->first();

        // get the email template
        $template = EmailTemplate::where('code', $this->userDepositReleasedEmailId)->get()->first();
        $adminTemplate = EmailTemplate::where('code', $this->adminDepositReleasedEmailId)->get()->first();

        if (!$template) return;

        // run replacements
        $replacements = array_merge($event->deposit->toArray(), $user->toArray());

        //send mail to user
        Mail::to($user)->queue(new UserEmail($template, $replacements));
        //send mail to admin
        Mail::queue(new AdminEmail($adminTemplate, $replacements));
    }
}
