<?php

namespace App\Domain\Interaction\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Interaction\Entities\Contact;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\Interaction\Http\Resources\Contact\ContactResource;
use App\Domain\Interaction\Criteria\Contact\ContactSortedByCriteria;
use App\Domain\Interaction\Http\Requests\Contact\ContactFormRequest;
use App\Domain\Interaction\Repositories\Contracts\ContactRepository;
use App\Domain\Interaction\Criteria\Contact\ContactFiltrationCriteria;
use App\Domain\Interaction\Http\Requests\Contact\ContactUpdateFormRequest;
use App\Domain\Interaction\Http\Resources\Contact\ContactResourceCollection;

class ContactController extends BaseController
{
    /**
     * @var ContactRepository
     */
    private $contactRepository;

    /**
     */
    public function __construct()
    {
        $this->contactRepository = app()->make(ContactRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->contactRepository->getModel());
    
        $this->contactRepository->pushCriteria(ContactSortedByCriteria::class);
        $this->contactRepository->pushCriteria(ContactFiltrationCriteria::class);

        $contacts = $this->contactRepository->paginate()->withQueryString();

        $this->setData('contacts', $contacts);

        $this->addView('Contact/ContactsIndex');

        $this->useCollection(ContactResourceCollection::class, 'contacts');

        return $this->response();

    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(Contact $contact)
    {        
        $this->authorize('view', $contact);

        $this->setData('contact', $contact);

        $this->addView('Contact/ContactsShow');

        $this->useCollection(ContactResource::class, 'contact');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(Contact $contact = null)
    {
        if($contact){
            $this->authorize('update', $contact);
        }else{
            $this->authorize('create', $this->contactRepository->getModel());
        }

        $this->setData('contact', $contact);

        $this->addView('Contact/ContactsCreate');

        $this->useCollection(ContactResource::class, 'contact');

        return $this->response();
    }

    /**
     * Create New Contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(ContactFormRequest $request, Contact $contact = null)
    {
        $validated = $request->validated();

        if($request instanceof ContactUpdateFormRequest){
            $contact->update($validated);
            $message = 'Contact Updated Successfully';
         }else{
            $contact = $this->contactRepository->create($validated);
            $message = 'Contact Created Successfully';
        }

        
        $this->flashMessage('success', $message);

        $this->setData('contact', $contact, 'api');

        $this->useCollection(ArticleResource::class, 'contact');

        $this->redirectRoute('contacts.show', $contact->id);

        return $this->response();
    }

    
    /**
     * Create New Contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);

        $this->contactRepository->remove($contact);

        $this->setData('contact', $contact);

        $this->useCollection(ContactResource::class, 'contact');

        $this->redirectRouteWithQueryParams('contacts.index');
        
        return $this->response();
    } 
}