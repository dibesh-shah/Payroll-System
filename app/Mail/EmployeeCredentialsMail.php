<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmployeeCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $password, $email, $first_name;

    /**
     * Create a new message instance.
     *
     * @param string $password The randomly generated password.
     */
    public function __construct($password, $email, $first_name)
    {
        $this->password = $password;
        $this->email = $email;
        $this->first_name = $first_name;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Employee Account Credentials')
            ->markdown('emails.employee_credentials');
    }
}
