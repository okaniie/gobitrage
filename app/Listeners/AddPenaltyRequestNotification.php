<?php

namespace App\Listeners;

use App\Events\AddPenaltyRequestEvent;
use App\Mail\AdminEmail;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Mail;

class AddPenaltyRequestNotification
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
     * @param  \App\Events\AddPenaltyRequestEvent  $event
     * @return void
     */
    public function handle(AddPenaltyRequestEvent $event)
    {
        $penalty = $event->penalty;
        $amount = $penalty->amount;
        $username = $penalty->user()->first()->username;

        $penaltyUrl = route('admin.users.penalty.confirm', ['token' => $penalty->token]);
        $template = new EmailTemplate();
        $template->subject = "Subtract Penalty Request";
        $template->content  = "You requested to subtract a penalty of \${$amount} from {$username}. Please follow this link to complete the operation.
        <a href='{$penaltyUrl}'>{$penaltyUrl}</a>";

        //send mail to admin
        Mail::send(new AdminEmail($template));
    }
}
