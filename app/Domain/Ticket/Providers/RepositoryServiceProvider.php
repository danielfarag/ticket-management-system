<?php

namespace App\Domain\Ticket\Providers;

use App\Domain\Ticket\Entities\Note;
use App\Domain\Ticket\Entities\Status;
use App\Domain\Ticket\Entities\Survey;
use App\Domain\Ticket\Entities\Ticket;
use Illuminate\Support\ServiceProvider;
use App\Domain\Ticket\Entities\Severity;
use App\Domain\Ticket\Entities\Department;
use App\Domain\Ticket\Entities\Escalation;
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
        \App\Domain\Ticket\Repositories\Contracts\DepartmentRepository::class => \App\Domain\Ticket\Repositories\Eloquent\DepartmentRepositoryEloquent::class,
			\App\Domain\Ticket\Repositories\Contracts\EscalationRepository::class => \App\Domain\Ticket\Repositories\Eloquent\EscalationRepositoryEloquent::class,
			\App\Domain\Ticket\Repositories\Contracts\NoteRepository::class => \App\Domain\Ticket\Repositories\Eloquent\NoteRepositoryEloquent::class,
			\App\Domain\Ticket\Repositories\Contracts\SeverityRepository::class => \App\Domain\Ticket\Repositories\Eloquent\SeverityRepositoryEloquent::class,
			\App\Domain\Ticket\Repositories\Contracts\StatusRepository::class => \App\Domain\Ticket\Repositories\Eloquent\StatusRepositoryEloquent::class,
			\App\Domain\Ticket\Repositories\Contracts\SurveyRepository::class => \App\Domain\Ticket\Repositories\Eloquent\SurveyRepositoryEloquent::class,
			\App\Domain\Ticket\Repositories\Contracts\TicketRepository::class => \App\Domain\Ticket\Repositories\Eloquent\TicketRepositoryEloquent::class,
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
            'departments'    => Department::class,
            'escalations'    => Escalation::class,
            'notes'          => Note::class,
            'severities'      => Severity::class,
            'statuses'        => Status::class,
            'surveys'        => Survey::class,
            'tickets'        => Ticket::class,
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
