<?php

namespace App\Domain\General\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class PolicyServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Domain\General\Entities\Category::class => \App\Domain\General\Policies\CategoryPolicy::class,
		\App\Domain\General\Entities\Service::class => \App\Domain\General\Policies\ServicePolicy::class,
		\App\Domain\General\Entities\Slider::class => \App\Domain\General\Policies\SliderPolicy::class,
		\App\Domain\General\Entities\Todo::class => \App\Domain\General\Policies\TodoPolicy::class,
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
