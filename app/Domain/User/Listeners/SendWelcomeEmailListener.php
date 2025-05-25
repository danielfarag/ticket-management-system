<?php

namespace App\Domain\User\Listeners;

use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Domain\User\Events\UserCreatedEvent;
use App\Domain\User\Mail\WelcomeEmail;

class SendWelcomeEmailListener implements ShouldQueue
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
     * @param  UserCreatedEvent $event
     * @return void
     */
    public function handle(UserCreatedEvent $event)
    {
        Mail::to($event->user)->send(new WelcomeEmail($event->user));
    }
}
