<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use App\Traits\UserEmailsTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminEmail extends Mailable
{
    use Queueable, SerializesModels, UserEmailsTrait;

    public string $messageText;
    public string $subjectText;

    /**
     * Email template
     */
    public EmailTemplate $template;

    /**
     * Replacements
     */
    public array $replacements;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(EmailTemplate $template, array $replacements = [])
    {
        $this->template = $template;
        $this->replacements = $replacements;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        [$this->subjectText, $this->messageText] =
            $this->prepareTemplate($this->template, $this->replacements);

        return $this
            ->subject($this->subjectText)
            ->to(env('MAIL_FROM_ADDRESS', 'hello@gobitrage.com'), env('MAIL_FROM_NAME', 'Gobitrage'))
            ->view('emails.baseemail');
    }
}
