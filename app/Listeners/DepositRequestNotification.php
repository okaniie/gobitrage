<?php

namespace App\Listeners;

use App\Events\DepositRequestEvent;
use App\Mail\AdminEmail;
use App\Mail\UserEmail;
use App\Models\EmailTemplate;
use App\Traits\UserEmailsTrait;
use Illuminate\Support\Facades\Mail;

class DepositRequestNotification
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
     * @param  \App\Events\DepositRequestEvent  $event
     * @return void
     */
    public function handle(DepositRequestEvent $event)
    {
        /**
         * @var \App\Models\User
         */
        $user = $event->deposit->user()->first();

        // get the email template
        $template = EmailTemplate::where('code', $this->userDepositRequestEmailId)->get()->first();
        $adminTemplate = EmailTemplate::where('code', $this->adminDepositRequestEmailId)->get()->first();

        if (!$template) return;

        // run replacements
        $replacements = array_merge($event->deposit->toArray(), $user->toArray());

        //send mail to user
        Mail::to($user)->queue(new UserEmail($template, $replacements));
        //send mail to admin
        Mail::queue(new AdminEmail($adminTemplate, $replacements));
    }
}
