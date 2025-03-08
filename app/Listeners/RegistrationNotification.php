<?php

namespace App\Listeners;

use App\Mail\AdminEmail;
use App\Mail\UserEmail;
use App\Models\EmailTemplate;
use App\Traits\UserEmailsTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class RegistrationNotification
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
     * @param  \App\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        /**
         * @var \App\Models\User
         */
        $user = $event->user;

        // get the email template
        $template = EmailTemplate::where('code', $this->userRegistrationEmailId)->get()->first();
        $adminTemplate = EmailTemplate::where('code', $this->adminRegistrationEmailId)->get()->first();

        if (!$template) return;

        // run replacements
        $replacements = array_merge($user->toArray());

        //send mail to user
        Mail::to($user)->queue(new UserEmail($template, $replacements));
        //send mail to admin
        Mail::queue(new AdminEmail($adminTemplate, $replacements));
    }
}
