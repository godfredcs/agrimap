<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupportMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The email of applicant sending message
     *
     * @var
     */
    public $sender_email;

     /**
     * The name of applicant sending message
     *
     * @var
     */
    public $sender_name;

    /**
     * The telephone of applicant sending message
     *
     * @var
     */
    public $telephone;

    /**
     * The subject of message
     *
     * @var
     */
    public $subject;

    /**
     * The body of the message
     *
     * @var
     */
    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->sender_name = $data['sender_name'];
        $this->sender_email = $data['sender_email'];
        $this->telephone  = $data['telephone'];
        $this->subject    = $data['subject'];
        $this->body       = $data['body'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->sender_email)
                ->view('emails.contact');
    }
}
