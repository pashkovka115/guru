<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $subject = 'Бронирование';


    public function __construct($order)
    {
        $this->order = $order;
    }


    public function build()
    {
        return $this->view('email.order', ['order' => $this->order]);
    }
}
