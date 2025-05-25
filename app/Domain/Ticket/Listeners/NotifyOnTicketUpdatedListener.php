<?php

namespace App\Domain\Ticket\Listeners;

use App\Domain\Ticket\Events\TicketCreatedEvent;
use Prettus\Repository\Events\RepositoryEntityUpdated;
use App\Domain\Ticket\Notifications\TicketUpdatedNotification;

class NotifyOnTicketUpdatedListener 
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RepositoryEntityUpdated $event
     * @return void
     */
    public function handle(TicketCreatedEvent $event)
    {
        $ticket = $event->ticket;

        $ticket->user->notify(new TicketUpdatedNotification($ticket));
    }
}
