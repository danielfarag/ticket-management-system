<?php

namespace App\Domain\Ticket\Policies;

use App\Domain\Ticket\Entities\Severity;
use App\Domain\User\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeverityPolicy
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
        return $user->can('read_severity');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Severity  $severity
     * @return mixed
     */
    public function view(User $user, Severity $severity)
    {
        return $user->can('read_severity');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_severity');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Severity  $severity
     * @return mixed
     */
    public function update(User $user, Severity $severity)
    {
        return $user->can('update_severity');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Severity  $severity
     * @return mixed
     */
    public function delete(User $user, Severity $severity)
    {
        return $user->can('delete_severity');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Severity  $severity
     * @return mixed
     */
    public function restore(User $user, Severity $severity)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Severity  $severity
     * @return mixed
     */
    public function forceDelete(User $user, Severity $severity)
    {
        //
    }
}
