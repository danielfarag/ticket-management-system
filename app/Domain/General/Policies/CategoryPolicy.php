<?php

namespace App\Domain\General\Policies;

use App\Domain\General\Entities\Category;
use App\Domain\User\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
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
        return $user->can('read_category');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\General\Entities\Category  $category
     * @return mixed
     */
    public function view(User $user, Category $category)
    {
        return $user->can('read_category');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_category');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\General\Entities\Category  $category
     * @return mixed
     */
    public function update(User $user, Category $category)
    {
        return $user->can('update_category');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\General\Entities\Category  $category
     * @return mixed
     */
    public function delete(User $user, Category $category)
    {
        return $user->can('delete_category');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\General\Entities\Category  $category
     * @return mixed
     */
    public function restore(User $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\General\Entities\Category  $category
     * @return mixed
     */
    public function forceDelete(User $user, Category $category)
    {
        //
    }
}
