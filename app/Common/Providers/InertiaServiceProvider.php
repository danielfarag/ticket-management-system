<?php

namespace App\Common\Providers;

use Illuminate\Support\ServiceProvider;

class InertiaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            app_path('Domain/User/Resources') => resource_path('js'),
            app_path('Domain/General/Resources') => resource_path('js'),
            app_path('Domain/Cms/Resources') => resource_path('js'),
            app_path('Domain/Ticket/Resources') => resource_path('js'),
            app_path('Domain/Interaction/Resources') => resource_path('js'),
            app_path('Domain/Setting/Resources') => resource_path('js'),
            app_path('Domain/Website/Resources') => resource_path('js'),
        ], 'inertia');
    }
}
