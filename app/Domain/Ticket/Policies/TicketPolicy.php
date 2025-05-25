<?php

namespace App\Domain\Ticket\Policies;

use App\Domain\Ticket\Entities\Ticket;
use App\Domain\User\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('read_ticket');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Ticket  $ticket
     * @return mixed
     */
    public function view(User $user, Ticket $ticket)
    {
        return ( $user->can('read_ticket') && ( $user->type == 'admin' || $ticket->agents()->wherePivot('agent_id', $user->id)->exists()) ) || $user->id == $ticket->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_ticket') || $user->type != 'agent';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Ticket  $ticket
     * @return mixed
     */
    public function update(User $user, Ticket $ticket)
    {
        return ( $user->can('update_ticket') && ( $user->type == 'admin' || $ticket->agents()->wherePivot('agent_id', $user->id)->exists()) ) || $user->id == $ticket->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Ticket  $ticket
     * @return mixed
     */
    public function delete(User $user, Ticket $ticket)
    {
        return ( $user->can('delete_ticket') && ( $user->type == 'admin' || $ticket->agents()->wherePivot('agent_id', $user->id)->exists()) ) || $user->id == $ticket->user_id;
    }

    /**
     * Determine whether the user can rate the ticket.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Ticket  $ticket
     * @return mixed
     */
    public function survey(User $user, Ticket $ticket)
    {
        return $user->id == $ticket->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Ticket  $ticket
     * @return mixed
     */
    public function restore(User $user, Ticket $ticket)
    {
        return $user->can('restore_ticket') && ( $user->type == 'admin' || $ticket->agents()->wherePivot('agent_id', $user->id)->exists());
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Ticket  $ticket
     * @return mixed
     */
    public function forceDelete(User $user, Ticket $ticket)
    {
        return $user->can('force_delete_ticket') && ( $user->type == 'admin' || $ticket->agents()->wherePivot('agent_id', $user->id)->exists());
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Ticket  $ticket
     * @return mixed
     */
    public function manageCategories(User $user)
    {
        return $user->can('manage_ticket_categories');
    }
}
