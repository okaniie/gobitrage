<?php

namespace App\Listeners;

use App\Events\WithdrawalRequestEvent;
use App\Mail\AdminEmail;
use App\Mail\UserEmail;
use App\Models\EmailTemplate;
use App\Traits\UserEmailsTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class WithdrawalRequestNotification
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
     * @param  \App\Events\WithdrawalRequest  $event
     * @return void
     */
    public function handle(WithdrawalRequestEvent $event)
    {
        /**
         * @var \App\Models\User
         */
        $user = $event->withdrawal->user()->first();

        // get the email template
        $template = EmailTemplate::where('code', $this->userWithdrawalRequestEmailId)->get()->first();
        $adminTemplate = EmailTemplate::where('code', $this->adminWithdrawalRequestEmailId)->get()->first();

        if (!$template) return;

        // run replacements
        $replacements = array_merge($event->withdrawal->toArray(), $user->toArray());

        //send mail to user
        Mail::to($user)->queue(new UserEmail($template, $replacements));
        //send mail to admin
        Mail::queue(new AdminEmail($adminTemplate, $replacements));
    }
}
