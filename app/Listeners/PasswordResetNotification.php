<?php

namespace App\Listeners;

use App\Mail\UserEmail;
use App\Models\EmailTemplate;
use App\Traits\UserEmailsTrait;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PasswordResetNotification
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
     * @param  \App\Events\PasswordReset  $event
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        /**
         * @var \App\Models\User
         */
        $user = $event->user;

        // get the email template
        $template = EmailTemplate::where('code', $this->userPasswordResetEmailId)->get()->first();

        if (!$template) return;

        //send mail to user
        // run replacements
        $replacements = array_merge($user->toArray());

        //send mail to user
        Mail::to($user)->queue(new UserEmail($template, $replacements));
    }
}
