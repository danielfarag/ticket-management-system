<?php

namespace App\Domain\User\Providers;

use App\Domain\User\Entities\Role;
use App\Domain\User\Entities\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Repositories Array With Interface as a Key and Eloquent as a Value.
     *
     * @var array
     */
    private $repositories = [
        \App\Domain\User\Repositories\Contracts\UserRepository::class => \App\Domain\User\Repositories\Eloquent\UserRepositoryEloquent::class,
			\App\Domain\User\Repositories\Contracts\RoleRepository::class => \App\Domain\User\Repositories\Eloquent\RoleRepositoryEloquent::class,
			###REPOSITORIES_PLACEHOLDER###
		// Your Repos Here "interface => eloquent class"
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Bind all repositories to application.
         */
        foreach ($this->repositories as $interface => $eloquent) {
            $this->app->bind($interface, $eloquent);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'users'      => User::class,
            'roles'      => Role::class,
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array_keys($this->repositories);
    }
}
