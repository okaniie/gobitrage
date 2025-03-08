<?php

namespace App\Listeners;

use App\Events\AddPenaltyConfirmedEvent;
use App\Mail\AdminEmail;
use App\Mail\UserEmail;
use App\Models\EmailTemplate;
use App\Models\User;
use App\Traits\UserEmailsTrait;
use Illuminate\Support\Facades\Mail;

class AddPenaltyConfirmedNotification
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
     * @param  \App\Events\AddPenaltyConfirmedEvent  $event
     * @return void
     */
    public function handle(AddPenaltyConfirmedEvent $event)
    {
        $user = User::findOrFail($event->penalty->user_id);
        $username = $user->username;
        $amount = $event->penalty->amount;

        if ($event->penalty->notify) {

            $template = EmailTemplate::where('code', $this->userAddPenaltyConfirmedEmailId)->get()->first();
            Mail::to($user)->queue(new UserEmail($template, array_merge($event->penalty->toArray(), $user->toArray())));
        }

        $adminTemplate = new EmailTemplate();
        $adminTemplate->subject = "Penalty Subtracted from  User";
        $adminTemplate->content = "A penalty of \${$amount} has been subtracted from {$username} successfully.";
        Mail::send(new AdminEmail($adminTemplate));
    }
}
