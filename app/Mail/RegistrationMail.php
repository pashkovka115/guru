<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;


    public function __construct($user, $password=null)
    {
        $this->user = $user;
        $this->password = $password;
    }


    public function build()
    {
        return $this->view('email.registrations', [
            'user' => $this->user,
            'password' => $this->password
        ]);
    }
}
