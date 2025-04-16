<?php

namespace App\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecruitationRegister extends Mailable
{
    use Queueable, SerializesModels;

    public $recruitation;

    /**
     * Create a new message instance.
     *
     * @param $recruitation
     */
    public function __construct($recruitation)
    {
        $this->recruitation = $recruitation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('recruitation_confirmation');
    }
}
