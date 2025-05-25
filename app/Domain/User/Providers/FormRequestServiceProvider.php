<?php

namespace App\Domain\User\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\User\Http\Requests\Role\RoleFormRequest;
use App\Domain\User\Http\Requests\User\UserFormRequest;
use App\Domain\User\Http\Requests\Role\RoleStoreFormRequest;
use App\Domain\User\Http\Requests\User\UserStoreFormRequest;
use App\Domain\User\Http\Requests\Role\RoleUpdateFormRequest;
use App\Domain\User\Http\Requests\User\UserUpdateFormRequest;

class FormRequestServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * formRequests Array With Interface as a Key and Eloquent as a Value.
     *
     * @var array
     */
    private $formRequests = [
        UserFormRequest::class => [
            UserStoreFormRequest::class,
            UserUpdateFormRequest::class
        ],
        RoleFormRequest::class => [
            RoleStoreFormRequest::class,
            RoleUpdateFormRequest::class
        ]
			###formRequests_PLACEHOLDER###
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
         * Bind all formRequests to application.
         */
        foreach ($this->formRequests as $interface => $formRequest) {
            if(request()->has('id')){
                $this->app->bind($interface, $formRequest[1]);
            }else{
                $this->app->bind($interface, $formRequest[0]);
            }
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array_keys($this->formRequests);
    }
}
