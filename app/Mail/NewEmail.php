<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    protected $profile;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($profile, $email)
    {
        $this->profile = $profile;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newEmail')
        ->subject($this->email->title)
        //->from($this->email->send_by, 'Bitdyne Company')
        ->from('contact@bitdyne.com', 'Bitdyne')
        //->replyTo('aymane.attat@uit.ac.ma', 'Bitdyne Company')
        ->with([
            'profile'=> $this->profile,
            'email' => $this->email,
        ]);
    }
}
