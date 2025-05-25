<?php

namespace App\Domain\Ticket\Policies;

use App\Domain\Ticket\Entities\Escalation;
use App\Domain\User\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EscalationPolicy
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
        return $user->can('read_escalation');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Escalation  $escalation
     * @return mixed
     */
    public function view(User $user, Escalation $escalation)
    {
        return $user->can('read_escalation') && ( $user->type == 'admin' || $escalation->ticket->agents()->wherePivot('agent_id', $user->id)->exists());;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_escalation');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Escalation  $escalation
     * @return mixed
     */
    public function update(User $user, Escalation $escalation)
    {
        return $user->can('update_escalation') && ( $user->type == 'admin' || $escalation->ticket->agents()->wherePivot('agent_id', $user->id)->exists());;;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Escalation  $escalation
     * @return mixed
     */
    public function delete(User $user, Escalation $escalation)
    {
        return $user->can('delete_escalation') && ( $user->type == 'admin' || $escalation->ticket->agents()->wherePivot('agent_id', $user->id)->exists());;;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Escalation  $escalation
     * @return mixed
     */
    public function restore(User $user, Escalation $escalation)
    {
        return $user->can('restore_escalation') && ( $user->type == 'admin' || $escalation->ticket->agents()->wherePivot('agent_id', $user->id)->exists());;;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Escalation  $escalation
     * @return mixed
     */
    public function forceDelete(User $user, Escalation $escalation)
    {
        return $user->can('force_delete_escalation') && ( $user->type == 'admin' || $escalation->ticket->agents()->wherePivot('agent_id', $user->id)->exists());;;
    }
}
