<?php

namespace App\Domain\Ticket\Mail;

use App\Domain\Interaction\Traits\HasMailTemplate;
use App\Domain\Ticket\Entities\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketCreated extends Mailable
{
    use Queueable, SerializesModels, HasMailTemplate;

    /**
     * Ticket Instance
     */
    public $ticket;

    /**
     * Created User
     *
     * @var User
     */
    private $type = 'ticket_created';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;

        $placeholders = [
            '[user_name]'      => $this->ticket->user->name,
            '[user_email]'     => $this->ticket->user->email,
            '[url]'            => route('website.tickets.show', $this->ticket->id),
            '[subject]'        => $this->ticket->subject,
            '[created_at]'     => $this->ticket->created_at,
        ];
        
        $this->buildMailBody($placeholders);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown("tickets::mails.TicketCreated")
        ->subject($this->subject ?? config('app.name') . ' - Ticket Created - ' . $this->ticket->subject);
        ;
    }
}
