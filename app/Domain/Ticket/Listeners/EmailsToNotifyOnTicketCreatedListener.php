<?php

namespace App\Domain\Ticket\Listeners;

use App\Domain\Setting\Repositories\Contracts\SettingRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Domain\Ticket\Events\TicketCreatedEvent;
use App\Domain\Ticket\Mail\NotifyEmails;
use Illuminate\Support\Facades\Mail;

class EmailsToNotifyOnTicketCreatedListener implements ShouldQueue
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

        $emails = $this->settingRepository->where('key', 'emails_notify')->first();

        if($emails){
            $mails = explode('|', $emails->value);

            Mail::to($mails)->send(new NotifyEmails($ticket));
        }
    }
}
