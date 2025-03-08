<?php

namespace App\Listeners;

use App\Events\DepositApproved;
use App\Mail\AdminEmail;
use App\Mail\UserEmail;
use App\Models\EmailTemplate;
use App\Traits\UserEmailsTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class DepositApprovedNotification
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
     * @param  \App\Events\DepositApproved  $event
     * @return void
     */
    public function handle(DepositApproved $event)
    {
        /**
         * @var \App\Models\User
         */
        $user = $event->deposit->user()->first();

        // get the email template
        $template = EmailTemplate::where('code', $this->userDepositApprovedEmailId)->get()->first();
        $adminTemplate = EmailTemplate::where('code', $this->adminDepositApprovedEmailId)->get()->first();

        if (!$template) return;

        // run replacements
        foreach ($event->deposit as $key => $value) {
            if (preg_match("#{$key}#", $template->content)) {
                $template->content = str_replace("#{$key}#", $value, $template->content);
                $adminTemplate->content = str_replace("#{$key}#", $value, $adminTemplate->content);
            }
        }

        // run replacements
        $replacements = array_merge($event->deposit->toArray(), $user->toArray());

        //send mail to user
        Mail::to($user)->queue(new UserEmail($template, $replacements));
        //send mail to admin
        Mail::queue(new AdminEmail($adminTemplate, $replacements));
    }
}
