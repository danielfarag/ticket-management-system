<?php

namespace App\Domain\Ticket\Policies;

use App\Domain\Ticket\Entities\Status;
use App\Domain\User\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusPolicy
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
        return $user->can('read_status');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function view(User $user, Status $status)
    {
        return $user->can('read_status');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_status');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Status  $status
     * @return mixed
     */
    public function update(User $user, Status $status)
    {
        return $user->can('update_status');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Status  $status
     * @return mixed
     */
    public function delete(User $user, Status $status)
    {
        return $user->can('delete_status');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Status  $status
     * @return mixed
     */
    public function restore(User $user, Status $status)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Status  $status
     * @return mixed
     */
    public function forceDelete(User $user, Status $status)
    {
        //
    }
}
