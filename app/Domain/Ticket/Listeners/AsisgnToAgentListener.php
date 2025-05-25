<?php

namespace App\Domain\Ticket\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Domain\Ticket\Entities\Ticket;
use App\Domain\Ticket\Events\TicketCreatedEvent;
use App\Domain\Ticket\Mail\AgentTicketHandlingMail;
use App\Domain\User\Repositories\Contracts\UserRepository;

class AsisgnToAgentListener 
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
     * @param  TicketCreatedEvent $event
     * @return void
     */
    public function handle(TicketCreatedEvent $event)
    {
        if($event->ticket->agents()->count() > 0){
            return;
        }

        $agent = $this->assign($event->ticket);

        if($agent){
            Mail::to($agent)->queue(new AgentTicketHandlingMail($event->ticket));
        }else{
            Mail::to('general-support@domain.com')->queue(new AgentTicketHandlingMail($event->ticket));
        }
    }

    private function assign(Ticket $ticket){
        $userRepository = app()->make(UserRepository::class);

        $ticket->load('categories.departments.agents');

        $agents = collect([]);
        
        $ticket->category->departments->map(function($department) use(&$agents){
            $agents = $agents->merge($department->agents->pluck('id'));
        });
    
        if($agents->count()){
            $agent = $userRepository->view()->whereIn('id',$agents->toArray())->orderBy('tickets_assigned', 'asc')->first();
            $ticket->agents()->attach($agent);
            return $agent;
        }

        return false;
    }
}
