<?php

namespace App\Domain\General\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\General\Http\Requests\Slider\SliderFormRequest;
use App\Domain\General\Http\Requests\Slider\SliderStoreFormRequest;
use App\Domain\General\Http\Requests\Slider\SliderUpdateFormRequest;
use App\Domain\General\Http\Requests\Comment\CommentFormRequest;
use App\Domain\General\Http\Requests\Comment\CommentStoreFormRequest;
use App\Domain\General\Http\Requests\Comment\CommentUpdateFormRequest;
use App\Domain\General\Http\Requests\Service\ServiceFormRequest;
use App\Domain\General\Http\Requests\Service\ServiceStoreFormRequest;
use App\Domain\General\Http\Requests\Service\ServiceUpdateFormRequest;
use App\Domain\General\Http\Requests\Category\CategoryFormRequest;
use App\Domain\General\Http\Requests\Category\CategoryStoreFormRequest;
use App\Domain\General\Http\Requests\Category\CategoryUpdateFormRequest;
use App\Domain\General\Http\Requests\Todo\TodoFormRequest;
use App\Domain\General\Http\Requests\Todo\TodoStoreFormRequest;
use App\Domain\General\Http\Requests\Todo\TodoUpdateFormRequest;

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
        CategoryFormRequest::class => [
            CategoryStoreFormRequest::class,
            CategoryUpdateFormRequest::class
        ],
        CommentFormRequest::class => [
            CommentStoreFormRequest::class,
            CommentUpdateFormRequest::class
        ],
        ServiceFormRequest::class => [
            ServiceStoreFormRequest::class,
            ServiceUpdateFormRequest::class
        ],
        SliderFormRequest::class => [
            SliderStoreFormRequest::class,
            SliderUpdateFormRequest::class
        ],
        TodoFormRequest::class => [
            TodoStoreFormRequest::class,
            TodoUpdateFormRequest::class
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
