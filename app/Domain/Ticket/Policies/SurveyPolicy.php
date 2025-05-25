<?php

namespace App\Domain\Ticket\Policies;

use App\Domain\Ticket\Entities\Survey;
use App\Domain\User\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SurveyPolicy
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
        return $user->can('read_survey');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Survey  $survey
     * @return mixed
     */
    public function view(User $user, Survey $survey)
    {
        return $user->can('read_survey');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_survey');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Survey  $survey
     * @return mixed
     */
    public function update(User $user, Survey $survey)
    {
        return $user->can('update_survey');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Survey  $survey
     * @return mixed
     */
    public function delete(User $user, Survey $survey)
    {
        return $user->can('delete_survey');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Survey  $survey
     * @return mixed
     */
    public function restore(User $user, Survey $survey)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Survey  $survey
     * @return mixed
     */
    public function forceDelete(User $user, Survey $survey)
    {
        //
    }
}
