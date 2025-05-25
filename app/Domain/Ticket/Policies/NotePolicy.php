<?php

namespace App\Domain\Ticket\Policies;

use App\Domain\Ticket\Entities\Note;
use App\Domain\User\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
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
        return $user->can('read_note');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Note  $note
     * @return mixed
     */
    public function view(User $user, Note $note)
    {
        return $user->can('read_note');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_note');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Note  $note
     * @return mixed
     */
    public function update(User $user, Note $note)
    {
        return $user->can('update_note');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Note  $note
     * @return mixed
     */
    public function delete(User $user, Note $note)
    {
        return $user->can('delete_note');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Note  $note
     * @return mixed
     */
    public function restore(User $user, Note $note)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Note  $note
     * @return mixed
     */
    public function forceDelete(User $user, Note $note)
    {
        //
    }
}
