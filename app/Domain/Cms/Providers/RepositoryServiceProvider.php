<?php

namespace App\Domain\Cms\Providers;

use App\Domain\Cms\Entities\Faq;
use App\Domain\Cms\Entities\Article;
use Illuminate\Support\ServiceProvider;
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
        \App\Domain\Cms\Repositories\Contracts\ArticleRepository::class => \App\Domain\Cms\Repositories\Eloquent\ArticleRepositoryEloquent::class,
			\App\Domain\Cms\Repositories\Contracts\FaqRepository::class => \App\Domain\Cms\Repositories\Eloquent\FaqRepositoryEloquent::class,
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
            'articles'   => Article::class,
            'faqs'       => Faq::class,
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
