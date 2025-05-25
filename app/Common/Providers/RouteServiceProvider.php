<?php

namespace App\Common\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapBroadcastRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')->group(base_path('routes/web.php'));
    }


    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::middleware('api')->prefix('api/')->name('api.')->group(base_path('routes/api.php'));
    }

    
    /**
     * Define the "broadcast" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapBroadcastRoutes()
    {
        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}
