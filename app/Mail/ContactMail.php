<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact_array;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact_array)
    {
        $this->contact_array = $contact_array;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('docs.author.contactmail');
    }
}
