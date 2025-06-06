<?php

namespace App\Domain\Ticket\Mail;

use App\Domain\Ticket\Entities\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SurveyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Ticket Instance
     */
    public $ticket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown("tickets::mails.Survey");
    }
}
