<?php

namespace App\Domain\Ticket\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
		\App\Domain\Ticket\Events\TicketCreatedEvent::class => [
			\App\Domain\Ticket\Listeners\NotifyOnTicketCreatedListener::class,
			\App\Domain\Ticket\Listeners\AsisgnToAgentListener::class,
			\App\Domain\Ticket\Listeners\EmailsToNotifyOnTicketCreatedListener::class,
				###LISTENERS_TicketCreatedEvent###
		
		],
		###EVENTS###
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        ###OBSERVERS####
    }
}
