<?php

namespace App\Domain\User\Policies;

use App\Domain\User\Entities\User;
use App\Domain\User\Entities\User as UserEntity;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return $user->can('read_user');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function view(User $user, UserEntity $entity)
    {
        return $user->can('read_user') && ( $user->type == 'admin' || ( $user->type == 'agent' && $entity->type == 'user') );
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_user');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function update(User $user, UserEntity $entity)
    {
        return $user->can('update_user') && ( $user->type == 'admin' || ( $user->type == 'agent' && $entity->type == 'user') );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function delete(User $user, UserEntity $entity)
    {
        return $user->can('delete_user') && ( $user->type == 'admin' || ( $user->type == 'agent' && $entity->type == 'user') );
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function restore(User $user, UserEntity $entity)
    {
        return $user->can('restore_user') && ( $user->type == 'admin' || ( $user->type == 'agent' && $entity->type == 'user') );
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function forceDelete(User $user, UserEntity $entity)
    {
        return $user->can('force_delete_user') && ( $user->type == 'admin' || ( $user->type == 'agent' && $entity->type == 'user') );
    }
}
