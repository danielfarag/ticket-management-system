<?php

namespace App\Domain\Setting\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Setting\Entities\BlockIp;
use App\Domain\Setting\Entities\Setting;
use App\Domain\Setting\Entities\QuickLink;
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
        \App\Domain\Setting\Repositories\Contracts\BlockIpRepository::class => \App\Domain\Setting\Repositories\Eloquent\BlockIpRepositoryEloquent::class,
			\App\Domain\Setting\Repositories\Contracts\QuickLinkRepository::class => \App\Domain\Setting\Repositories\Eloquent\QuickLinkRepositoryEloquent::class,
			\App\Domain\Setting\Repositories\Contracts\SettingRepository::class => \App\Domain\Setting\Repositories\Eloquent\SettingRepositoryEloquent::class,
			\App\Domain\Setting\Repositories\Contracts\MemberRepository::class => \App\Domain\Setting\Repositories\Eloquent\MemberRepositoryEloquent::class,
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
            'block_ips'      => BlockIp::class,
            'quick_links'    => QuickLink::class,
            'settings'      => Setting::class,
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
