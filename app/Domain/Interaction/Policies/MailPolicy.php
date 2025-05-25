<?php

namespace App\Domain\Interaction\Policies;

use App\Domain\Interaction\Entities\Mail;
use App\Domain\User\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MailPolicy
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
        return $user->can('read_mail');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Interaction\Entities\Mail  $mail
     * @return mixed
     */
    public function view(User $user, Mail $mail)
    {
        return $user->can('read_mail');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_mail');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Interaction\Entities\Mail  $mail
     * @return mixed
     */
    public function update(User $user, Mail $mail)
    {
        return $user->can('update_mail');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Interaction\Entities\Mail  $mail
     * @return mixed
     */
    public function delete(User $user, Mail $mail)
    {
        return $user->can('delete_mail');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Interaction\Entities\Mail  $mail
     * @return mixed
     */
    public function restore(User $user, Mail $mail)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Interaction\Entities\Mail  $mail
     * @return mixed
     */
    public function forceDelete(User $user, Mail $mail)
    {
        //
    }
}
