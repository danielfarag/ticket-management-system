<?php

namespace App\Domain\Setting\Providers;

use App\Infrastructure\AbstractProviders\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Alias for load Translations and views.
     *
     * @var string
     */
    protected $alias = 'settings';

    /**
     * Set if will load commands or not.
     *
     * @var bool
     */
    protected $hasCommands = true;

    /**
     * Set if will load migrations or not.
     *
     * @var bool
     */
    protected $hasMigrations = true;

    /**
     * Set if will load translations or not.
     *
     * @var bool
     */
    protected $hasTranslations = true;

    /**
     * Set if will load factories or not.
     *
     * @var bool
     */
    protected $hasFactories = true;

    /**
     * Set if will load policies or not.
     *
     * @var bool
     */
    protected $hasPolicies = true;

    /**
     * Set if will load Views or not.
     *
     * @var bool
     */
    protected $hasViews = true;

    /**
     * Set if will load Views or not.
     *
     * @var bool
     */
    protected $hasObservers = true;

    /**
     * List of custom Artisan commands.
     *
     * @var array
     */
    protected $commands = [];

    /**
     * List of providers to load.
     *
     * @var array
     */
    protected $providers = [
        RouteServiceProvider::class,
        RepositoryServiceProvider::class,
        HelperServiceProvider::class,
        EventServiceProvider::class,
        PolicyServiceProvider::class,
        FormRequestServiceProvider::class
    ];

    /**
     * List of policies to load.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * List of model factories to load.
     *
     * @var array
     */
    protected $factories = [];


    /**
     * List of Model Obserbers to load.
     *
     * @var array
     */
    protected $observers = [];
}
