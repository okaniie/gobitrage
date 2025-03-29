<?php

namespace App\Listeners;

use App\Events\AdminLoggedInEvent;
use App\Mail\AdminEmail;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Log;
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
        // Skip email notification if mail is not configured
        if (!config('mail.from.address')) {
            Log::info('Admin login notification skipped - mail not configured');
            return;
        }

        try {
            $IP = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
            $template = new EmailTemplate();
            $template->subject = "Admin Logged In";
            $template->content = "Admin logged into control panel from IP: $IP; Time: " . now() . ".";

            //send mail to admin
            Mail::send(new AdminEmail($template));
        } catch (\Exception $e) {
            // Log the error but don't prevent login
            Log::warning('Failed to send admin login notification: ' . $e->getMessage());
        }
    }
}
