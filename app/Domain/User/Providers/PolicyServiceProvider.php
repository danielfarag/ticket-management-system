<?php

namespace App\Domain\User\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class PolicyServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Domain\User\Entities\Role::class => \App\Domain\User\Policies\RolePolicy::class,
		\App\Domain\User\Entities\User::class => \App\Domain\User\Policies\UserPolicy::class,
		###POLICIES###
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
