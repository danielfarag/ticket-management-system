<?php

namespace App\Domain\Website\Http\Controllers;

use App\Domain\Ticket\Http\Resources\Ticket\TicketResourceCollection;
use App\Domain\Ticket\Repositories\Contracts\TicketRepository;
use Illuminate\Http\Request;
use App\Domain\User\Repositories\Contracts\UserRepository;
use App\Domain\User\Http\Requests\Auth\UserUpdateFormRequest;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\User\Http\Requests\Auth\UserUpdatePasswordFormRequest;
use App\Domain\User\Http\Resources\User\UserResource;
use Throwable;

class ProfileController extends BaseController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var TicketRepository
     */
    private $ticketRepository;

    /**
     * initialize userRepository
     */
    public function __construct()
    {
        $this->userRepository = app()->make(UserRepository::class);
        $this->ticketRepository = app()->make(TicketRepository::class);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function me(Request $request)
    {
        $tickets = $this->ticketRepository->view()->where('user_id',auth()->id())->orderByDesc('id')->get();

        $this->setData('tickets', $tickets->take(5));

        $this->addView('Website/Profile/Me');
        $this->useCollection(TicketResourceCollection::class, 'tickets');

        return $this->response();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function notifications(Request $request)
    {
        $notifications = auth()->user()->notifications;
        $this->setData('notifications', $notifications);

        $this->addView('Website/Profile/Notifications');

        $this->setApiResponse(function() use($notifications){
            return response()->json([
                'notifications' => auth()->user()->notifications,
            ]);
        });

        return $this->response();
    }

    /**
     * Update current authenticated user password
     *
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function updatePassword(UserUpdatePasswordFormRequest $request){
        
        try{
            $this->userRepository->update($request->validated(), auth()->id());
            $type = 'success';
            $message = 'User Updated Successfully';
        }catch(Throwable $th){
            $type = 'error';
            $message = 'Failed to update the user';
        }

        $this->flashMessage($type, $message);

        $this->setData('user', auth()->user(), 'api');

        $this->useCollection(UserResource::class, 'user');
        
        $this->redirectRouteWithQueryParams('me');
        return $this->response();
    }


    /**
     * Update current authenticated user
     *
     * @return \App\Domain\User\Http\Resources\User\UserResource
     */
    public function updateProfile(UserUpdateFormRequest $request){
    
        try{
            $this->userRepository->update($request->validated(), auth()->id());
            $type = 'success';
            $message = 'User Updated Successfully';
        }catch(Throwable $th){
            $type = 'error';
            $message = 'Failed to update the user';
        }

        $this->flashMessage($type, $message);

        $this->setData('user', auth()->user(), 'api');

        $this->useCollection(UserResource::class, 'user');
        
        $this->redirectRouteWithQueryParams('me');
        return $this->response();
    }
}