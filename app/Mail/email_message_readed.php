<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class email_message_readed extends Mailable
{
    use Queueable, SerializesModels;
    public $datetime_readed;
    public $recipient_email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datetime_readed,$recipient_email)
    {
        $this->datetime_readed = $datetime_readed;
        $this->recipient_email = $recipient_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('One Time Message - Message Read '.$this->recipient_email)
                    ->view('emails.email_message_readed');
    }
}
