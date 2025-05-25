<?php

namespace App\Domain\Ticket\Notifications;

use App\Domain\Ticket\Entities\Ticket;
use App\Domain\Ticket\Mail\TicketUpdated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class TicketUpdatedNotification extends Notification implements ShouldQueue
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
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new TicketUpdated($this->entity))->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => 'Notififcation Title.',
            'content' => 'You Have New Notification',
            'entity' => [
                'model' => 'App\\Domain\\Ticket\\Entities\\_ENTITY_',
                'id' => '_ID_',
                // 'url' => route('__view_name__.show', '_ID_'),
                'data' => [],
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];
    }
}
