<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class AdverseReactionNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $type;

    public function __construct($data, $type = 'user')
    {
        $this->data = $data;
        $this->type = $type;
    }

    public function build()
    {
        if ($this->type === 'admin') {
            return $this->subject('New Adverse Reaction Report')
            ->view('frontend.mail.adverse-reaction-admin');
        }        
        return $this->subject('Your Adverse Reaction Report Submission')
        ->view('frontend.mail.adverse-reaction-user');
    }
}