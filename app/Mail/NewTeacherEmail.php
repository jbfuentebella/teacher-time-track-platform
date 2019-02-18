<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewTeacherEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $tempAccount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tempAccount)
    {
        $this->tempAccount = $tempAccount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Account Verification - New Teacher')
            ->markdown('emails.registration.new-teacher');
    }
}
