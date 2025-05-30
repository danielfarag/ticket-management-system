<?php

namespace App\Infrastructure\AbstractProviders;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class ServiceProvider extends LaravelServiceProvider
{
    /**
     * @var string Alias for load Translations and views
     */
    protected $alias;

    /**
     * @var bool Set if will load commands or not
     */
    protected $hasCommands = false;

    /**
     * @var bool Set if will load factories or not
     */
    protected $hasFactories = false;

    /**
     * @var bool Set if will load migrations or not
     */
    protected $hasMigrations = false;

    /**
     * @var bool Set if will load translations or not
     */
    protected $hasTranslations = false;

    /**
     * @var bool Set if will load Views or not
     */
    protected $hasViews = false;

    /**
     * @var bool Set if will load policies or not
     */
    protected $hasPolicies = false;

    /**
     * @var bool Set if will load policies or not
     */
    protected $hasObservers = false;

    /**
     * @var array List of custom Artisan commands
     */
    protected $commands = [];

    /**
     * @var array List of model factories to load
     */
    protected $factories = [];

    /**
     * @var array List of providers to load
     */
    protected $providers = [];

    /**
     * @var array List of policies to load
     */
    protected $policies = [];

    /**
     * @var array List of policies to load
     */
    protected $observers = [];

    /**
     * Boot required registering of views and translations.
     *
     * @throws \ReflectionException
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
       
        $this->registerPolicies();
        $this->registerCommands();
        $this->registerFactories();
        $this->registerMigrations();
        $this->registerTranslations();
        $this->registerViews();
        $this->registerObservers();        
    }

    /**
     * Register the application's policies.
     *
     * @return void
     */
    public function registerPolicies()
    {
        if ($this->hasPolicies) {
            foreach ($this->policies as $key => $value) {
                Gate::policy($key, $value);
            }
        }
    }

    /**
     * Register domain custom Artisan commands.
     */
    protected function registerCommands()
    {
        if ($this->hasCommands) {
            $this->commands($this->commands);
        }
    }

    /**
     * Register Model Factories.
     */
    protected function registerFactories()
    {
        if ($this->hasFactories) {
            Factory::guessFactoryNamesUsing(function (string $modelName) {
                return Str::beforeLast($modelName, 'Entities')."Database\Factories\\".class_basename($modelName)."Factory";
            });
        }
    }

    /**
     * Register domain migrations.
     *
     * @throws \ReflectionException
     */
    protected function registerMigrations()
    {
        if ($this->hasMigrations) {
            $this->loadMigrationsFrom($this->domainPath('Database/Migrations'));
            $this->loadMigrationsFrom($this->domainPath('Database/Migrations/Tables'));
            $this->loadMigrationsFrom($this->domainPath('Database/Migrations/Views'));
            $this->loadMigrationsFrom($this->domainPath('Database/Migrations/Triggers'));
            $this->loadMigrationsFrom($this->domainPath('Database/Migrations/Constraints'));
        }
    }

    /**
     * Detects the domain base path so resources can be proper loaded on child classes.
     *
     * @param string $append
     * @return string
     * @throws \ReflectionException
     */
    protected function domainPath($append = null)
    {
        $reflection = new \ReflectionClass($this);

        $realPath = realpath(dirname($reflection->getFileName()) . '/../');

        if (!$append) {
            return $realPath;
        }

        return $realPath . '/' . $append;
    }

    /**
     * Register domain translations.
     *
     * @throws \ReflectionException
     */
    protected function registerTranslations()
    {
        if ($this->hasTranslations) {
            $this->loadTranslationsFrom($this->domainPath('Resources/lang'), $this->alias);
        }
    }

    /**
     * Register domain Views.
     * Use Views by $alias
     * @throws \ReflectionException
     */
    protected function registerViews()
    {
        if ($this->hasViews) {
            $this->loadViewsFrom($this->domainPath('Blades'), $this->alias);
        }
    }

    /**
     * Register domain Views.
     * Use Views by $alias
     * @throws \ReflectionException
     */
    protected function registerObservers()
    {
        if ($this->hasObservers) {
            foreach($this->observers as $model=>$observer){
                $model::observe($observer);
            }
        }
    }
    
    /**
     * Register Domain ServiceProviders.
     */
    public function register()
    {
        collect($this->providers)->each(function ($providerClass) {
            $this->app->register($providerClass);
        });
    }
    
}
