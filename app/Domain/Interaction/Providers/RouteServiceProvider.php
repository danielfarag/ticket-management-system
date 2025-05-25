<?php

namespace App\Domain\Interaction\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Domain\Interaction\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(app_path("Domain/Interaction/Routes/public.php"));

        Route::middleware(['web', 'guest'])
            ->namespace($this->namespace)
            ->group(app_path("Domain/Interaction/Routes/guest.php"));
        
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(app_path("Domain/Interaction/Routes/auth.php"));
    }
}
