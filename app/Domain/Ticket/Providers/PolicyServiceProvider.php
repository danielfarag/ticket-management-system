<?php

namespace App\Domain\Ticket\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class PolicyServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Domain\Ticket\Entities\Status::class => \App\Domain\Ticket\Policies\StatusPolicy::class,
		\App\Domain\Ticket\Entities\Department::class => \App\Domain\Ticket\Policies\DepartmentPolicy::class,
		\App\Domain\Ticket\Entities\Escalation::class => \App\Domain\Ticket\Policies\EscalationPolicy::class,
		\App\Domain\Ticket\Entities\Note::class => \App\Domain\Ticket\Policies\NotePolicy::class,
		\App\Domain\Ticket\Entities\Severity::class => \App\Domain\Ticket\Policies\SeverityPolicy::class,
		\App\Domain\Ticket\Entities\Status::class => \App\Domain\Ticket\Policies\StatusPolicy::class,
		\App\Domain\Ticket\Entities\Survey::class => \App\Domain\Ticket\Policies\SurveyPolicy::class,
		\App\Domain\Ticket\Entities\Ticket::class => \App\Domain\Ticket\Policies\TicketPolicy::class,
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
