<?php

namespace App\Domain\Website\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Domain\User\Repositories\Contracts\UserRepository;
use App\Domain\User\Http\Requests\Auth\UserLoginFormRequest;
use App\Domain\User\Http\Requests\Auth\UserResetFormRequest;
use App\Domain\User\Http\Requests\Auth\UserForgetFormRequest;
use App\Domain\User\Http\Requests\Auth\UserUpdateFormRequest;
use App\Domain\User\Http\Requests\Auth\UserRegisterFormRequest;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\User\Http\Requests\Auth\UserUpdatePasswordFormRequest;
use App\Domain\User\Http\Resources\User\UserResource;
use Throwable;

class AuthenticationController extends BaseController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * initialize userRepository
     */
    public function __construct()
    {
        $this->userRepository = app()->make(UserRepository::class);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  \App\Domain\User\Http\Requests\Auth\UserLoginFormRequest  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function login(UserLoginFormRequest $request)
    {

        if (!Auth::attempt($request->only(['email','password']), $request->only('remember'))) {

            $this->flashMessage('error', 'Failed to login, check your credentials and try again.');
           
            $this->setApiResponse(function(){
                return response()->json(['login'=>'failed']);
            });
            $this->redirectRouteWithQueryParams('login');
        }else{
            $this->flashMessage('success', 'Login Successfully.');

            $this->setData('user', auth()->user());
            $this->useCollection(UserResource::class, 'user');

            $this->redirectRouteWithQueryParams('home');
        }

        return $this->response();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\Domain\User\Http\Resources\User\UserResource
     */
    public function register(UserRegisterFormRequest $request)
    {
        try {
            $user = $this->userRepository->create($request->validated());
            
            Auth::login($user);

            $this->flashMessage('success', 'New Account Created.');

            $this->setData('user', auth()->user());
            $this->useCollection(UserResource::class, 'user');

            $this->redirectRouteWithQueryParams('home');

        } catch (\Throwable $ex) {

            $this->flashMessage('error', 'Can not create new account.');
           
            $this->setApiResponse(function(){
                return response()->json(['register'=>'failed']);
            });
            $this->redirectRouteWithQueryParams('register');
        }

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

        $this->setData('user', auth()->user(), 'api');

        $this->flashMessage($type, $message);
           
        $this->useCollection(UserResource::class, 'user');

        $this->redirectRouteWithQueryParams('me.update');

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

        $this->setData('user', auth()->user(), 'api');
        
        $this->flashMessage($type, $message);
           
        $this->useCollection(UserResource::class, 'user');

        $this->redirectRouteWithQueryParams('me.update');

        return $this->response();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  \App\Domain\User\Http\Requests\Auth\UserResetFormRequest  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function resetAction(UserResetFormRequest $request) {

        $reset_password_status = Password::reset($request->validated(), function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        $passed = false;

        if ($reset_password_status == Password::INVALID_TOKEN) {
            $this->flashMessage('error', 'Invalid token. Failed to reset your password.');
            
            $this->redirectRouteWithQueryParams('reset');

        }else{
            $this->flashMessage('success', 'Password Reset successfully.');

            $this->redirectRouteWithQueryParams('login');
            $passed = true;
        }

           
        $this->setApiResponse(function() use($passed){
            return response()->json([
                'reset'=>$passed
            ]);
        });

        return $this->response();
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  \App\Domain\User\Http\Requests\Auth\UserForgetFormRequest  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function forget(UserForgetFormRequest $request)
    {
        $sent = false;
        try {
            Password::sendResetLink($request->validated());
            $sent = true;
            $type = 'success';
            $message = 'Mail Sent successfully.';
    
        } catch (\Throwable $ex) {
            $type = 'error';
            $message = 'Can not send the mail.';
        }

        $this->flashMessage($type, $message);

        $this->redirectRouteWithQueryParams('login');

        $this->setApiResponse(function() use($sent){
            return response()->json([
                'sent'=>$sent
            ]);
        });

        return $this->response();

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function logout(Request $request)
    {
        $logout = false;
        try {
            auth()->logout();
            $logout = true;
            [$type, $message] = ['success', 'Logout successfully.'];
    
        } catch (\Throwable $ex) {
            [$type, $message] = ['error', 'Can not logout.'];
        }

        $this->flashMessage($type, $message);

        $this->redirectRouteWithQueryParams('home');
        
        $this->setApiResponse(function() use($logout){
            return response()->json([
                'logout'=>$logout
            ]);
        });

        return $this->response();
    }

}