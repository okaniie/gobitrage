<?php

namespace App\Listeners;

use App\Events\AddBonusConfirmedEvent;
use App\Mail\AdminEmail;
use App\Mail\UserEmail;
use App\Models\EmailTemplate;
use App\Models\User;
use App\Traits\UserEmailsTrait;
use Illuminate\Support\Facades\Mail;

class AddBonusConfirmedNotification
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
     * @param  \App\Events\AddBonusConfirmedEvent  $event
     * @return void
     */
    public function handle(AddBonusConfirmedEvent $event)
    {
        $user = User::findOrFail($event->bonus->user_id);
        $username = $user->username;
        $amount = $event->bonus->amount;

        if ($event->bonus->notify) {

            $template = EmailTemplate::where('code', $this->userAddBonusConfirmedEmailId)->get()->first();
            Mail::to($user)->queue(new UserEmail($template, array_merge($event->bonus->toArray(), $user->toArray())));
        }

        $adminTemplate = new EmailTemplate();
        $adminTemplate->subject = "Bonus Added to User";
        $adminTemplate->content = "A bonus of \${$amount} has been added to {$username} successfully.";
        Mail::send(new AdminEmail($adminTemplate));
    }
}
