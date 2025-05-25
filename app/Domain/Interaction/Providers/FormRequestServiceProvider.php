<?php

namespace App\Domain\Interaction\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Interaction\Http\Requests\Mail\MailFormRequest;
use App\Domain\Interaction\Http\Requests\Mail\MailStoreFormRequest;
use App\Domain\Interaction\Http\Requests\Contact\ContactFormRequest;
use App\Domain\Interaction\Http\Requests\Mail\MailUpdateFormRequest;
use App\Domain\Interaction\Http\Requests\Contact\ContactStoreFormRequest;
use App\Domain\Interaction\Http\Requests\Contact\ContactUpdateFormRequest;
use App\Domain\Interaction\Http\Requests\Announcement\AnnouncementFormRequest;
use App\Domain\Interaction\Http\Requests\MailTemplate\MailTemplateFormRequest;
use App\Domain\Interaction\Http\Requests\Announcement\AnnouncementStoreFormRequest;
use App\Domain\Interaction\Http\Requests\MailTemplate\MailTemplateStoreFormRequest;
use App\Domain\Interaction\Http\Requests\Announcement\AnnouncementUpdateFormRequest;
use App\Domain\Interaction\Http\Requests\MailTemplate\MailTemplateUpdateFormRequest;

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
        AnnouncementFormRequest::class => [
            AnnouncementStoreFormRequest::class,
            AnnouncementUpdateFormRequest::class
        ],
        ContactFormRequest::class => [
            ContactStoreFormRequest::class,
            ContactUpdateFormRequest::class
        ],
        MailFormRequest::class => [
            MailStoreFormRequest::class,
            MailUpdateFormRequest::class
        ],
        MailTemplateFormRequest::class => [
            MailTemplateStoreFormRequest::class,
            MailTemplateUpdateFormRequest::class
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
