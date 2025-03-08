<?php

namespace App\Listeners;

use App\Events\AdminLoggedInEvent;
use App\Mail\AdminEmail;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Mail;

class AdminLoggedInNotification
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
     * @param  \App\Events\AdminLoggedInEvent  $event
     * @return void
     */
    public function handle(AdminLoggedInEvent $event)
    {
        $IP = $_SERVER['REMOTE_ADDR'];
        $template = new EmailTemplate();
        $template->subject = "Admin Logged In";
        $template->content  = "Admin logged into control panel from IP: $IP; Time: " . now() . ".";

        //send mail to admin
        Mail::send(new AdminEmail($template));
    }
}
