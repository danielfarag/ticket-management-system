<?php

namespace App\Domain\Interaction\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Interaction\Entities\Contact;
use App\Domain\Interaction\Entities\Announcement;
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
        \App\Domain\Interaction\Repositories\Contracts\AnnouncementRepository::class => \App\Domain\Interaction\Repositories\Eloquent\AnnouncementRepositoryEloquent::class,
			\App\Domain\Interaction\Repositories\Contracts\ContactRepository::class => \App\Domain\Interaction\Repositories\Eloquent\ContactRepositoryEloquent::class,
			\App\Domain\Interaction\Repositories\Contracts\MailRepository::class => \App\Domain\Interaction\Repositories\Eloquent\MailRepositoryEloquent::class,
			\App\Domain\Interaction\Repositories\Contracts\MailTemplateRepository::class => \App\Domain\Interaction\Repositories\Eloquent\MailTemplateRepositoryEloquent::class,
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
            'announcements'     => Announcement::class,
            'contacts'          => Contact::class,
            'mails'             => Mail::class,
            'mail_templates'    => MailTemplate::class,
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
