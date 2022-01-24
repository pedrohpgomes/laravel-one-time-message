<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class email_confirm_message extends Mailable
{
    use Queueable, SerializesModels;
    public $purl_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($purl_code)
    {
        $this->purl_code = $purl_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Message Confirmation')
                    ->view('emails.email_confirm_message');
    }
}
