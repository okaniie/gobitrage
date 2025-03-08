<?php

namespace App\Listeners;

use App\Events\NewsletterEvent;
use App\Mail\NewsletterEmail;
use Illuminate\Support\Facades\Mail;

class NewsletterNotification
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
     * @param  \App\Events\NewsletterEvent  $event
     * @return void
     */
    public function handle(NewsletterEvent $event)
    {
        /**
         * @var \App\Models\User
         */
        foreach ($event->recipients as $recipient) {
            Mail::to($recipient)->queue(new NewsletterEmail($event->subject, $event->message, $recipient));
        }
    }
}
