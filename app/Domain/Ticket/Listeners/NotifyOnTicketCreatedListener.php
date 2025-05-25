<?php

namespace App\Domain\Ticket\Listeners;

use App\Domain\Ticket\Events\TicketCreatedEvent;
use App\Domain\Ticket\Notifications\TicketCreatedNotification;
use App\Domain\Setting\Repositories\Contracts\SettingRepository;

class NotifyOnTicketCreatedListener 
{
    /**
     * Define Setting Repository 
     *
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->settingRepository= app()->make(SettingRepository::class);
    }

    /**
     * Handle the event.
     *
     * @param  TicketCreatedEvent $event
     * @return void
     */
    public function handle(TicketCreatedEvent $event)
    {
        $ticket = $event->ticket;

        $ticket = $event->ticket;

        $notify = $this->settingRepository->where('key', 'sent_mail_ticket_created')->first();

        if($notify && $notify->value){
            $ticket->user->notify(new TicketCreatedNotification($ticket));
        }
    }
}
