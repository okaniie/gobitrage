<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterEmail extends Mailable
{
    use Queueable, SerializesModels;

    public string $messageText;
    public string $subjectText;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $subject, string $message)
    {
        $this->subjectText = $subject;
        $this->messageText = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subjectText)->view('emails.baseemail');
    }
}
