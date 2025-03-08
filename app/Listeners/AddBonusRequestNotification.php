<?php

namespace App\Listeners;

use App\Events\AddBonusRequestEvent;
use App\Mail\AdminEmail;
use App\Models\EmailTemplate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class AddBonusRequestNotification
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
     * @param  \App\Events\AddBonusRequestEvent  $event
     * @return void
     */
    public function handle(AddBonusRequestEvent $event)
    {
        $bonus = $event->bonus;
        $amount = $bonus->amount;
        $username = $bonus->user()->first()->username;

        $bonusUrl = route('admin.users.bonus.confirm', ['token' => $bonus->token]);
        $template = new EmailTemplate();
        $template->subject = "Add Bonus Request";
        $template->content  = "You requested to add a bonus of \${$amount} to {$username}. Please follow this link to complete the operation.
        <a href='{$bonusUrl}'>{$bonusUrl}</a>";

        //send mail to admin
        Mail::send(new AdminEmail($template));
    }
}
