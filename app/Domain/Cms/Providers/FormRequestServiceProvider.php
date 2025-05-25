<?php

namespace App\Domain\Cms\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Cms\Http\Requests\Faq\FaqFormRequest;
use App\Domain\Cms\Http\Requests\Faq\FaqStoreFormRequest;
use App\Domain\Cms\Http\Requests\Faq\FaqUpdateFormRequest;
use App\Domain\Cms\Http\Requests\Article\ArticleFormRequest;
use App\Domain\Cms\Http\Requests\Article\ArticleStoreFormRequest;
use App\Domain\Cms\Http\Requests\Article\ArticleUpdateFormRequest;

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
        ArticleFormRequest::class => [
            ArticleStoreFormRequest::class,
            ArticleUpdateFormRequest::class
        ],
        FaqFormRequest::class => [
            FaqStoreFormRequest::class,
            FaqUpdateFormRequest::class
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
