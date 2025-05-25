<?php

namespace App\Domain\Setting\Policies;

use App\Domain\Setting\Entities\QuickLink;
use App\Domain\User\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuicklinkPolicy
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
        return $user->can('read_quick_link');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Setting\Entities\QuickLink  $quicklink
     * @return mixed
     */
    public function view(User $user, QuickLink $quicklink)
    {
        return $user->can('read_quick_link');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_quick_link');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Setting\Entities\QuickLink  $quicklink
     * @return mixed
     */
    public function update(User $user, QuickLink $quicklink)
    {
        return $user->can('update_quick_link');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Setting\Entities\QuickLink  $quicklink
     * @return mixed
     */
    public function delete(User $user, QuickLink $quicklink)
    {
        return $user->can('delete_quick_link');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Setting\Entities\QuickLink  $quicklink
     * @return mixed
     */
    public function restore(User $user, QuickLink $quicklink)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Setting\Entities\QuickLink  $quicklink
     * @return mixed
     */
    public function forceDelete(User $user, QuickLink $quicklink)
    {
        //
    }
}
