<?php

namespace App\Domain\Ticket\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Ticket\Http\Requests\Note\NoteFormRequest;
use App\Domain\Ticket\Http\Requests\Status\StatusFormRequest;
use App\Domain\Ticket\Http\Requests\Survey\SurveyFormRequest;
use App\Domain\Ticket\Http\Requests\Ticket\TicketFormRequest;
use App\Domain\Ticket\Http\Requests\Note\NoteStoreFormRequest;
use App\Domain\Ticket\Http\Requests\Note\NoteUpdateFormRequest;
use App\Domain\Ticket\Http\Requests\Severity\SeverityFormRequest;
use App\Domain\Ticket\Http\Requests\Status\StatusStoreFormRequest;
use App\Domain\Ticket\Http\Requests\Survey\SurveyStoreFormRequest;
use App\Domain\Ticket\Http\Requests\Ticket\TicketStoreFormRequest;
use App\Domain\Ticket\Http\Requests\Status\StatusUpdateFormRequest;
use App\Domain\Ticket\Http\Requests\Survey\SurveyUpdateFormRequest;
use App\Domain\Ticket\Http\Requests\Ticket\TicketUpdateFormRequest;
use App\Domain\Ticket\Http\Requests\Department\DepartmentFormRequest;
use App\Domain\Ticket\Http\Requests\Escalation\EscalationFormRequest;
use App\Domain\Ticket\Http\Requests\Severity\SeverityStoreFormRequest;
use App\Domain\Ticket\Http\Requests\Severity\SeverityUpdateFormRequest;
use App\Domain\Ticket\Http\Requests\Department\DepartmentStoreFormRequest;
use App\Domain\Ticket\Http\Requests\Escalation\EscalationStoreFormRequest;
use App\Domain\Ticket\Http\Requests\Department\DepartmentUpdateFormRequest;
use App\Domain\Ticket\Http\Requests\Escalation\EscalationUpdateFormRequest;

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
        DepartmentFormRequest::class => [
            DepartmentStoreFormRequest::class,
            DepartmentUpdateFormRequest::class
        ],
        EscalationFormRequest::class => [
            EscalationStoreFormRequest::class,
            EscalationUpdateFormRequest::class
        ],
        NoteFormRequest::class => [
            NoteStoreFormRequest::class,
            NoteUpdateFormRequest::class
        ],
        SeverityFormRequest::class => [
            SeverityStoreFormRequest::class,
            SeverityUpdateFormRequest::class
        ],
        StatusFormRequest::class => [
            StatusStoreFormRequest::class,
            StatusUpdateFormRequest::class
        ],
        SurveyFormRequest::class => [
            SurveyStoreFormRequest::class,
            SurveyUpdateFormRequest::class
        ],
        TicketFormRequest::class => [
            TicketStoreFormRequest::class,
            TicketUpdateFormRequest::class
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
