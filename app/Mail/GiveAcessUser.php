<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GiveAcessUser extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $token;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($name,$token,$url)
    {
        $this->name = $name;
        $this->token = $token;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.registerUser');
    }
}
