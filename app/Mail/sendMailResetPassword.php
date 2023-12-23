<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendMailResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $linkReset;
    public $name;
    public function __construct($name = '', $linkReset = '')
    {
        $this->linkReset = $linkReset;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.resetPaword')->subject('Khôi phục mật khẩu')->with(['name' => $this->name, 'linkReset' => $this->linkReset]);
    }
}
