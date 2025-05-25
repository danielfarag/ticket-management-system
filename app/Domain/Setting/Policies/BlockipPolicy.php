<?php

namespace App\Domain\Setting\Policies;

use App\Domain\Setting\Entities\BlockIp;
use App\Domain\User\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlockipPolicy
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
        return $user->can('read_block_ip');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Setting\Entities\BlockIp  $blockip
     * @return mixed
     */
    public function view(User $user, BlockIp $blockip)
    {
        return $user->can('read_block_ip');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_block_ip');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Setting\Entities\BlockIp  $blockip
     * @return mixed
     */
    public function update(User $user, BlockIp $blockip)
    {
        return $user->can('update_block_ip');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Setting\Entities\BlockIp  $blockip
     * @return mixed
     */
    public function delete(User $user, BlockIp $blockip)
    {
        return $user->can('delete_block_ip');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Setting\Entities\BlockIp  $blockip
     * @return mixed
     */
    public function restore(User $user, BlockIp $blockip)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Setting\Entities\BlockIp  $blockip
     * @return mixed
     */
    public function forceDelete(User $user, BlockIp $blockip)
    {
        //
    }
}
