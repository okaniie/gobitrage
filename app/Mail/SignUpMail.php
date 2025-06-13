<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Traits\UserEmailsTrait; 
use App\Models\EmailTemplate;

class SignUpMail extends Mailable // Changed from WelcomeMail to SignUpMail
{
    use Queueable, SerializesModels, UserEmailsTrait;

    public $user;
    public $emailData;

    public function __construct($user)
    {
        $this->user = $user;
        // Get the template and prepare replacements
        $template = EmailTemplate::where('slug', $this->userRegistrationEmailId)->first();
        $replacements = [
            'user_name' => $user->name,
            'user_email' => $user->email,
            'login_url' => route('login'),
        ];
        
        list($subject, $message) = $this->prepareTemplate($template, $replacements);
        
        $this->emailData = [
            'subject' => $subject,
            'message' => $message
        ];
    }

    public function build()
    {
        return $this->subject($this->emailData['subject'])
                    ->view('emails.generic', [
                        'content' => $this->emailData['message'],
                        'user' => $this->user
                    ]);
    }
}