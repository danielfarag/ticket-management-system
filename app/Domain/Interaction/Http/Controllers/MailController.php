<?php

namespace App\Domain\Interaction\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Interaction\Entities\Mail;
use App\Domain\Interaction\Http\Resources\Mail\MailResource;
use App\Domain\Interaction\Criteria\Mail\MailSortedByCriteria;
use App\Domain\Interaction\Http\Requests\Mail\MailFormRequest;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\Interaction\Criteria\Mail\MailFiltrationCriteria;
use App\Domain\Interaction\Repositories\Contracts\MailRepository;
use App\Domain\Interaction\Http\Requests\Mail\MailUpdateFormRequest;
use App\Domain\Interaction\Http\Resources\Mail\MailResourceCollection;

class MailController extends BaseController
{
    /**
     * @var MailRepository
     */
    private $mailRepository;

    /**
     */
    public function __construct()
    {
        $this->mailRepository = app()->make(MailRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->mailRepository->getModel());
     
        $this->mailRepository->pushCriteria(MailSortedByCriteria::class);
        $this->mailRepository->pushCriteria(MailFiltrationCriteria::class);

        $mails = $this->mailRepository->paginate()->withQueryString();

        $this->setData('mails', $mails);

        $this->addView('Mail/MailsIndex');

        $this->useCollection(MailResourceCollection::class, 'mails');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(Mail $mail)
    {
        $this->authorize('view', $mail);

        $this->setData('mail', $mail);

        $this->addView('Mail/MailsShow');

        $this->useCollection(MailResource::class, 'mail');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(Mail $mail = null)
    {
        if($mail){
            $this->authorize('update', $mail);
        }else{
            $this->authorize('create', $this->mailRepository->getModel());
        }

        $this->setData('mail', $mail);

        $this->addView('Mail/MailsCreate');

        $this->useCollection(MailResource::class, 'mail');

        return $this->response();
    }

    /**
     * Create New Mail.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(MailFormRequest $request, Mail $mail = null)
    {
        $validated = $request->validated();

        if($request instanceof MailUpdateFormRequest){
            $mail->update($validated);
            $message = 'Mail Updated Successfully';
         }else{
            $mail = $this->mailRepository->create($validated);
            $message = 'Mail Created Successfully';
        }

        $this->flashMessage('success', $message);

        $this->setData('mail', $mail, 'api');

        $this->useCollection(MailResource::class, 'mail');

        $this->redirectRoute('mails.show', $mail->id);

        return $this->response();
    }

    
    /**
     * Create New Mail.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mail $mail)
    {
        $this->authorize('delete', $mail);

        $this->mailRepository->remove($mail);

        $this->setData('mail', $mail);

        $this->useCollection(MailResource::class, 'mail');

        $this->redirectRouteWithQueryParams('mails.index');
        
        return $this->response();
    } 
}