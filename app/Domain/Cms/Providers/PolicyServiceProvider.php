<?php

namespace App\Domain\Cms\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class PolicyServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Domain\Cms\Entities\Article::class => \App\Domain\Cms\Policies\ArticlePolicy::class,
		\App\Domain\Cms\Entities\Faq::class => \App\Domain\Cms\Policies\FaqPolicy::class,
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
