<?php

namespace App\Domain\Ticket\Notifications;

use App\Common\Services\DbNotification;
use App\Common\Services\NotificationEntity;
use App\Domain\Ticket\Entities\Ticket;
use App\Domain\Ticket\Mail\TicketCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class TicketCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Entity Instance.
     *
     * @var Ticket
     */
    public $entity;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Ticket $entity)
    {
        $this->entity = $entity;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new TicketCreated($this->entity))->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return DbNotification::generate(
            'ticket_created',
            NotificationEntity::generate($this->entity, 'website.tickets.show')
        );
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage(['data'=>$this->toArray($notifiable), 'read_at'=>null]);
    }
}
