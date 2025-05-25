<?php

namespace App\Domain\Setting\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class PolicyServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Domain\Setting\Entities\BlockIp::class => \App\Domain\Setting\Policies\BlockipPolicy::class,
		\App\Domain\Setting\Entities\QuickLink::class => \App\Domain\Setting\Policies\QuicklinkPolicy::class,
		\App\Domain\Setting\Entities\Setting::class => \App\Domain\Setting\Policies\SettingPolicy::class,
		\App\Domain\Setting\Entities\Member::class => \App\Domain\Setting\Policies\MemberPolicy::class,
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
