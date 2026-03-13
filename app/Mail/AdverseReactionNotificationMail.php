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
			return $this
			->from(config('mail.from.address'), config('mail.from.name'))
			->replyTo(config('mail.from.address'))
			->subject('Новый отчет о побочной реакции')
			->view('frontend.mail.adverse-reaction-admin');
		}
		return $this
		->from(config('mail.from.address'), config('mail.from.name'))
		->replyTo(config('mail.from.address'))
		->subject('Your Adverse Reaction Report Submission')
		->view('frontend.mail.adverse-reaction-user');
	}
}