<?php

namespace App\Domain\Website\Http\Controllers;

use App\Domain\Interaction\Http\Requests\Contact\ContactStoreFormRequest;
use App\Domain\Interaction\Http\Resources\Contact\ContactResource;
use App\Domain\Interaction\Repositories\Contracts\ContactRepository;
use Throwable;
use App\Infrastructure\Http\AbstractControllers\BaseController;

class ContactController extends BaseController
{
    /**
     * @var ContactRepository
     */
    private $contactRepository;

    /**
     * initialize contactRepository
     */
    public function __construct()
    {
        $this->contactRepository = app()->make(ContactRepository::class);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function send(ContactStoreFormRequest $request)
    {
        try{
            $contact = $this->contactRepository->create($request->validated());
            $type = 'success';
            $message = 'Contact Sent Successfully';
        }catch(Throwable $th){
            $type = 'error';
            $message = 'Failed to Sent Contact Request';
        }

        $this->flashMessage($type, $message);

        $this->setData('contact', $contact);

        $this->useCollection(ContactResource::class, 'contact');

        $this->redirectRouteWithQueryParams('home');
        
        return $this->response();
    }

}