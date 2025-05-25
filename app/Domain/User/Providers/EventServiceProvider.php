<?php

namespace App\Domain\User\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Domain\User\Events\UserCreatedEvent::class => [
			\App\Domain\User\Listeners\SendWelcomeEmailListener::class,
				###LISTENERS_UserCreatedEvent###
		
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

        \App\Domain\User\Entities\User::observe(\App\Domain\User\Observers\UserObserver::class);
		###OBSERVERS####
    }
}
