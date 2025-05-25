<?php

namespace App\Domain\Setting\Policies;

use App\Domain\Setting\Entities\Member;
use App\Domain\User\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberPolicy
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
        return $user->can('read_member');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Setting\Entities\Member  $member
     * @return mixed
     */
    public function view(User $user, Member $member)
    {
        return $user->can('read_member');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_member');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Setting\Entities\Member  $member
     * @return mixed
     */
    public function update(User $user, Member $member)
    {
        return $user->can('update_member');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Setting\Entities\Member  $member
     * @return mixed
     */
    public function delete(User $user, Member $member)
    {
        return $user->can('delete_member');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Setting\Entities\Member  $member
     * @return mixed
     */
    public function restore(User $user, Member $member)
    {
        return $user->can('restore_member');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Setting\Entities\Member  $member
     * @return mixed
     */
    public function forceDelete(User $user, Member $member)
    {
        return $user->can('force_delete_member');
    }
}
