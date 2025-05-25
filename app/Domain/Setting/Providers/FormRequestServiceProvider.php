<?php

namespace App\Domain\Setting\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Setting\Http\Requests\BlockIp\BlockIpFormRequest;
use App\Domain\Setting\Http\Requests\QuickLink\QuickLinkFormRequest;
use App\Domain\Setting\Http\Requests\BlockIp\BlockIpStoreFormRequest;
use App\Domain\Setting\Http\Requests\BlockIp\BlockIpUpdateFormRequest;
use App\Domain\Setting\Http\Requests\QuickLink\QuickLinkStoreFormRequest;
use App\Domain\Setting\Http\Requests\QuickLink\QuickLinkUpdateFormRequest;

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
        BlockIpFormRequest::class => [
            BlockIpStoreFormRequest::class,
            BlockIpUpdateFormRequest::class
        ],
        QuickLinkFormRequest::class => [
            QuickLinkStoreFormRequest::class,
            QuickLinkUpdateFormRequest::class
        ],
        \App\Domain\Setting\Http\Requests\Member\MemberFormRequest::class => [
            \App\Domain\Setting\Http\Requests\Member\MemberStoreFormRequest::class,
            \App\Domain\Setting\Http\Requests\Member\MemberUpdateFormRequest::class
        ],
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
