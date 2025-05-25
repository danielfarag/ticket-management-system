<?php

namespace App\Domain\Interaction\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class PolicyServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Domain\Interaction\Entities\Announcement::class => \App\Domain\Interaction\Policies\AnnouncementPolicy::class,
		\App\Domain\Interaction\Entities\Contact::class => \App\Domain\Interaction\Policies\ContactPolicy::class,
		\App\Domain\Interaction\Entities\Mail::class => \App\Domain\Interaction\Policies\MailPolicy::class,
		\App\Domain\Interaction\Entities\MailTemplate::class => \App\Domain\Interaction\Policies\MailtemplatePolicy::class,
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
