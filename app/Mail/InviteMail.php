<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $link;
    public $hotelName;

    /**
     * Create a new message instance.
     *
     * @param string $link
     * @return void
     */
    public function __construct($link , $hotelName )
    {
        $this->link = $link;
         $this->hotelName = $hotelName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invite')->with(['link' => $this->link]);
    }
}
