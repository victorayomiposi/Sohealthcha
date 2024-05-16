<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

    public $message;

    /**
     * Create a new message instance.
     *
     * @param string $message
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

   
    public function build()
    {
        return $this->subject('Feedback Mail - Ondo State School Of Health Candidate Registration Pin')
            ->view('emails.feedback');
    }
}