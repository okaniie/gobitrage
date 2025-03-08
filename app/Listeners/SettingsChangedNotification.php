<?php

namespace App\Listeners;

use App\Events\SettingsChangedEvent;
use App\Mail\AdminEmail;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Mail;

class SettingsChangedNotification
{
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
     * @param  \App\Events\SettingsChangedEvent  $event
     * @return void
     */
    public function handle(SettingsChangedEvent $event)
    {
        $IP = $_SERVER['REMOTE_ADDR'];
        $template = new EmailTemplate();
        $template->subject = "Site Settings Changed";
        $template->content  = "Some settings have been modified in the admin section from IP: $IP.";

        Mail::send(new AdminEmail($template));
    }
}
