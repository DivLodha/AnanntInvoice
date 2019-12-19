<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class invoice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'admin@anannt.com';
        $name = 'Anannt Training Institute';
        $subject = 'Payment Receipt';
        return $this->view('email.customer',['record'=>$node,'course'=>$course])->render()
        ->from($address, $name)
        ->subject($subject);
  }
}
