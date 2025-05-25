<?php

namespace App\Domain\General\Providers;

use App\Domain\General\Entities\Slider;
use Illuminate\Support\ServiceProvider;
use App\Domain\General\Entities\Comment;
use App\Domain\General\Entities\Service;
use App\Domain\General\Entities\Category;
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
			\App\Domain\General\Repositories\Contracts\CategoryRepository::class => \App\Domain\General\Repositories\Eloquent\CategoryRepositoryEloquent::class,
			\App\Domain\General\Repositories\Contracts\RateRepository::class => \App\Domain\General\Repositories\Eloquent\RateRepositoryEloquent::class,
			\App\Domain\General\Repositories\Contracts\ServiceRepository::class => \App\Domain\General\Repositories\Eloquent\ServiceRepositoryEloquent::class,
			\App\Domain\General\Repositories\Contracts\SliderRepository::class => \App\Domain\General\Repositories\Eloquent\SliderRepositoryEloquent::class,
			\App\Domain\General\Repositories\Contracts\CommentRepository::class => \App\Domain\General\Repositories\Eloquent\CommentRepositoryEloquent::class,
			\App\Domain\General\Repositories\Contracts\TodoRepository::class => \App\Domain\General\Repositories\Eloquent\TodoRepositoryEloquent::class,
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
            'categories'  => Category::class,
            'services'    => Service::class,
            'sliders'     => Slider::class,
            'comments'    => Comment::class,
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
