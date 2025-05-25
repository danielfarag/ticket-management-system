<?php

namespace App\Domain\User\Observers;

use App\Domain\User\Entities\User;

class UserObserver
{
    /**
     * Handle the user "creating" event.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->password = bcrypt($user->password);
    }

    /**
     * Handle the user "updating" event.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return void
     */
    public function updating(User $user)
    {
        if(request()->has('password') && request()->input('password') != null){
            $user->password = bcrypt($user->password);
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
