<?php

namespace App\Domain\Ticket\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TicketCreatedEvent
{
    use Dispatchable, SerializesModels;

    /**
     * User Instance.
     *
     * @var User
     */
    public $user;

    /**
     * Additional Data.
     *
     * @var \App\Domain\Ticket\Entities\Ticket
     */
    public $ticket;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $ticket)
    {
        $this->user = $user;
        $this->ticket = $ticket;
    }
}
