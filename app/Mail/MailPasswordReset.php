<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailPasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Password reset confirmation code')

        ->view('mail.passwordReset');
        /*
        $details = [

            'title' => 'Mail from ItSolutionStuff.com',

            'body' => 'This is for testing email using smtp'

        ];

        return $this->view('view.mail.passwordReset');
        */
    }
}