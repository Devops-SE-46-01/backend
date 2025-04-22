<?php

namespace App\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WorkshopInformation extends Mailable
{
    use Queueable, SerializesModels;

    public $workshop;

    /**
     * Create a new message instance.
     *
     * @param $workshop
     */
    public function __construct($workshop)
    {
        $this->workshop = $workshop;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('workshop_confirmation');
    }
}
