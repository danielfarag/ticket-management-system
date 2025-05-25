<?php

namespace App\Domain\General\Policies;

use App\Domain\General\Entities\Todo;
use App\Domain\User\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoPolicy
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
        return $user->can('read_todo');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\General\Entities\Todo  $todo
     * @return mixed
     */
    public function view(User $user, Todo $todo)
    {
        return $user->can('read_todo') && ( $user->type == 'admin' || ( $user->type == 'agent' && $todo->agent_id == auth()->id()) );
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_todo');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\General\Entities\Todo  $todo
     * @return mixed
     */
    public function update(User $user, Todo $todo)
    {
        return $user->can('update_todo') && ( $user->type == 'admin' || ( $user->type == 'agent' && $todo->agent_id == auth()->id()) );;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\General\Entities\Todo  $todo
     * @return mixed
     */
    public function delete(User $user, Todo $todo)
    {
        return $user->can('delete_todo') && ( $user->type == 'admin' || ( $user->type == 'agent' && $todo->agent_id == auth()->id()) );
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\General\Entities\Todo  $todo
     * @return mixed
     */
    public function restore(User $user, Todo $todo)
    {
        return $user->can('restore_todo') && ( $user->type == 'admin' || ( $user->type == 'agent' && $todo->agent_id == auth()->id()) );;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\General\Entities\Todo  $todo
     * @return mixed
     */
    public function forceDelete(User $user, Todo $todo)
    {
        return $user->can('force_delete_todo') && ( $user->type == 'admin' || ( $user->type == 'agent' && $todo->agent_id == auth()->id()) );;
    }
}
