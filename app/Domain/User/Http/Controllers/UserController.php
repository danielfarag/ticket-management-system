<?php

namespace App\Domain\User\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\User\Entities\User;
use App\Domain\User\Http\Resources\User\UserResource;
use App\Domain\User\Criteria\User\UserSortedByCriteria;
use App\Domain\User\Http\Requests\User\UserFormRequest;
use App\Domain\User\Criteria\User\UserFiltrationCriteria;
use App\Domain\User\Repositories\Contracts\RoleRepository;
use App\Domain\User\Repositories\Contracts\UserRepository;
use App\Domain\User\Http\Requests\User\UserUpdateFormRequest;
use App\Domain\User\Http\Resources\User\UserResourceCollection;
use App\Infrastructure\Http\AbstractControllers\BaseController;

class UserController extends BaseController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->userRepository->getModel());
       
        $this->userRepository->pushCriteria(UserSortedByCriteria::class);
        $this->userRepository->pushCriteria(UserFiltrationCriteria::class);

        $users = $this->userRepository->view()->paginate()->withQueryString();
        $roles = $this->roleRepository->select('name')->get()->keyBy('name')->keys();

        $this->setData('users', $users);
        $this->setData('roles', $roles);

        $this->addView('User/UsersIndex');

        $this->useCollection(UserResourceCollection::class, 'users');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        $this->setData('user', $user);

        $this->addView('User/UsersShow');

        $this->useCollection(UserResource::class, 'user');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(User $user = null)
    {
        if($user){
            $this->authorize('update', $user);
        }else{
            $this->authorize('create', $this->userRepository->getModel());
        }
        
        $roles = $this->roleRepository->all();

        $this->setData('user', $user);

        $this->setData('roles', $roles);

        $this->addView('User/UsersCreate');

        $this->useCollection(UserResource::class, 'user');

        return $this->response();
    }

    /**
     * Create New User.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(UserFormRequest $request, User $user = null)
    {
        $validated = $request->validated();

        if(array_key_exists('password', $validated) && empty($validated['password'])){
            unset($validated['password']);
        }

        if($request instanceof UserUpdateFormRequest){
            $user->update($validated);
            $message = 'User Updated Successfully';
         }else{
            $user = $this->userRepository->create($validated);
            $message = 'User Created Successfully';
        }

        if($validated['role_id']){
            $user->syncRoles($validated['role_id']);
        }
        
        $this->flashMessage('success', $message);

        $this->setData('user', $user, 'api');

        $this->useCollection(UserResource::class, 'user');

        $this->redirectRoute('users.show', $user->id);

        return $this->response();
    }

    
    /**
     * Create New User.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $this->userRepository->remove($user);

        $this->setData('user', $user);

        $this->useCollection(UserResource::class, 'user');

        $this->redirectRouteWithQueryParams('users.index');
        
        return $this->response();
    }

}