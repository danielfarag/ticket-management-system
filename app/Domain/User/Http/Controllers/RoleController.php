<?php

namespace App\Domain\User\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\User\Entities\Role;
use App\Domain\User\Criteria\Role\RoleSortedByCriteria;
use App\Domain\User\Http\Requests\Role\RoleFormRequest;
use App\Domain\User\Criteria\Role\RoleFiltrationCriteria;
use App\Domain\User\Repositories\Contracts\RoleRepository;
use App\Domain\User\Http\Requests\Role\RoleUpdateFormRequest;
use App\Domain\User\Http\Resources\Role\RoleResource;
use App\Domain\User\Http\Resources\Role\RoleResourceCollection;
use App\Infrastructure\Http\AbstractControllers\BaseController;

class RoleController extends BaseController
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     */
    public function __construct()
    {
        $this->roleRepository = app()->make(RoleRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->roleRepository->getModel());
      
        $this->roleRepository->pushCriteria(RoleSortedByCriteria::class);
        $this->roleRepository->pushCriteria(RoleFiltrationCriteria::class);

        $roles = $this->roleRepository->paginate()->withQueryString();

        $this->setData('roles', $roles);

        $this->addView('Role/RolesIndex');

        $this->useCollection(RoleResourceCollection::class, 'roles');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(Role $role)
    {
        $this->authorize('view', $role);
        
        $role->load(['permissions']);

        $this->setData('role', $role);
        $this->setData('permissions', $this->roleRepository->permissions);

        $this->addView('Role/RolesShow');

        $this->useCollection(RoleResource::class, 'role');

        return $this->response();

    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(Role $role = null)
    {
        if($role){
            $this->authorize('update', $role);
            $role->load(['permissions']);
        }else{
            $this->authorize('create', $this->roleRepository->getModel());
        }

        $this->setData('role', $role);
        $this->setData('permissions', $this->roleRepository->permissions);

        $this->addView('Role/RolesCreate');

        $this->useCollection(RoleResource::class, 'role');

        return $this->response();

    }

    /**
     * Create New Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(RoleFormRequest $request, Role $role = null)
    {
        $validated = $request->validated();

        if($request instanceof RoleUpdateFormRequest){
            $role->update($validated);
            $message = 'Role Updated Successfully';
         }else{
            $role = $this->roleRepository->create($validated);
            $message = 'Role Created Successfully';
        }

        $role->syncPermissions($request['permissions']);
        
        $this->flashMessage('success', $message);

        $this->setData('role', $role, 'api');

        $this->useCollection(RoleResource::class, 'role');

        $this->redirectRoute('roles.show', $role->id);

        return $this->response();
    }

    
    /**
     * Create New Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        $this->roleRepository->remove($role);

        $this->setData('role', $role);

        $this->useCollection(RoleResource::class, 'role');

        $this->redirectRouteWithQueryParams('roles.index');
        
        return $this->response();
    }

}