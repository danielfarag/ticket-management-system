<?php

namespace App\Domain\Interaction\Policies;

use App\Domain\Interaction\Entities\MailTemplate;
use App\Domain\User\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MailtemplatePolicy
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
        return $user->can('read_mail_template');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Interaction\Entities\MailTemplate  $mailtemplate
     * @return mixed
     */
    public function view(User $user, MailTemplate $mailtemplate)
    {
        return $user->can('read_mail_template');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_mail_template');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Interaction\Entities\MailTemplate  $mailtemplate
     * @return mixed
     */
    public function update(User $user, MailTemplate $mailtemplate)
    {
        return $user->can('update_mail_template');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Interaction\Entities\MailTemplate  $mailtemplate
     * @return mixed
     */
    public function delete(User $user, MailTemplate $mailtemplate)
    {
        return $user->can('delete_mail_template');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Interaction\Entities\MailTemplate  $mailtemplate
     * @return mixed
     */
    public function restore(User $user, MailTemplate $mailtemplate)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Interaction\Entities\MailTemplate  $mailtemplate
     * @return mixed
     */
    public function forceDelete(User $user, MailTemplate $mailtemplate)
    {
        //
    }
}
