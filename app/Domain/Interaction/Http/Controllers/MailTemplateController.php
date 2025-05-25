<?php

namespace App\Domain\Interaction\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Interaction\Entities\MailTemplate;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\Interaction\Repositories\Contracts\MailTemplateRepository;
use App\Domain\Interaction\Criteria\MailTemplate\MailTemplateSortedByCriteria;
use App\Domain\Interaction\Http\Requests\MailTemplate\MailTemplateFormRequest;
use App\Domain\Interaction\Criteria\MailTemplate\MailTemplateFiltrationCriteria;
use App\Domain\Interaction\Http\Requests\MailTemplate\MailTemplateUpdateFormRequest;
use App\Domain\Interaction\Http\Resources\MailTemplate\MailTemplateResource;
use App\Domain\Interaction\Http\Resources\MailTemplate\MailTemplateResourceCollection;

class MailTemplateController extends BaseController
{
    /**
     * @var MailTemplateRepository
     */
    private $mailTemplateRepository;

    /**
     */
    public function __construct()
    {
        $this->mailTemplateRepository = app()->make(MailTemplateRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->mailTemplateRepository->getModel());
       
        $this->mailTemplateRepository->pushCriteria(MailTemplateSortedByCriteria::class);
        $this->mailTemplateRepository->pushCriteria(MailTemplateFiltrationCriteria::class);

        $mailTemplates = $this->mailTemplateRepository->paginate()->withQueryString();

        $this->setData('mailTemplates', $mailTemplates);

        $this->addView('MailTemplate/MailTemplatesIndex');

        $this->useCollection(MailTemplateResourceCollection::class, 'mailTemplates');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(MailTemplate $mail_template)
    {
        $this->authorize('view', $mail_template);

        $this->setData('mailTemplate', $mail_template);

        $this->addView('MailTemplate/MailTemplatesShow');

        $this->useCollection(MailTemplateResource::class, 'mailTemplate');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(MailTemplate $mail_template = null)
    {
        if($mail_template){
            $this->authorize('update', $mail_template);
        }else{
            $this->authorize('create', $this->mailTemplateRepository->getModel());
        }

        $this->setData('mailTemplate', $mail_template);

        $this->addView('MailTemplate/MailTemplatesCreate');

        $this->useCollection(MailTemplateResource::class, 'mailTemplate');

        return $this->response();
    }

    /**
     * Create New MailTemplate.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(MailTemplateFormRequest $request, MailTemplate $mail_template = null)
    {
        $validated = $request->validated();

        if($request instanceof MailTemplateUpdateFormRequest){
            $mail_template->update($validated);
            $message = 'MailTemplate Updated Successfully';
         }else{
            $mail_template = $this->mailTemplateRepository->create($validated);
            $message = 'MailTemplate Created Successfully';
        }

        $this->flashMessage('success', $message);

        $this->setData('mailTemplate', $mail_template, 'api');

        $this->useCollection(MailTemplateResource::class, 'mailTemplate');

        $this->redirectRoute('mail_templates.show', $mail_template->id);

        return $this->response();
    }

    
    /**
     * Create New MailTemplate.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(MailTemplate $mail_template)
    {
        $this->authorize('delete', $mail_template);

        $this->mailTemplateRepository->remove($mail_template);

        $this->setData('mailTemplate', $mail_template);

        $this->useCollection(MailTemplateResource::class, 'mailTemplate');

        $this->redirectRouteWithQueryParams('mail_templates.index');
        
        return $this->response();
    } 
}