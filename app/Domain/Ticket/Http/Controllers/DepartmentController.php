<?php

namespace App\Domain\Ticket\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\User\Repositories\Contracts\UserRepository;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\General\Repositories\Contracts\CategoryRepository;
use App\Domain\Ticket\Repositories\Contracts\DepartmentRepository;
use App\Domain\Ticket\Criteria\Department\DepartmentSortedByCriteria;
use App\Domain\Ticket\Http\Requests\Department\DepartmentFormRequest;
use App\Domain\Ticket\Criteria\Department\DepartmentFiltrationCriteria;
use App\Domain\Ticket\Entities\Department;
use App\Domain\Ticket\Http\Requests\Department\DepartmentAgentsFormRequest;
use App\Domain\Ticket\Http\Requests\Department\DepartmentUpdateFormRequest;
use App\Domain\Ticket\Http\Resources\Department\DepartmentResource;
use App\Domain\Ticket\Http\Resources\Department\DepartmentResourceCollection;
use App\Domain\User\Http\Resources\User\UserResource;

class DepartmentController extends BaseController
{
    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     */
    public function __construct()
    {
        $this->departmentRepository = app()->make(DepartmentRepository::class);
        $this->categoryRepository = app()->make(CategoryRepository::class);
        $this->userRepository = app()->make(UserRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->departmentRepository->getModel());
   
        $this->departmentRepository->pushCriteria(DepartmentSortedByCriteria::class);
        $this->departmentRepository->pushCriteria(DepartmentFiltrationCriteria::class);

        $departments = $this->departmentRepository->view()->paginate()->withQueryString();

        $categories = $this->categoryRepository->where('type','tickets')->select('name')->get()->keyBy('name')->keys();
        
        $this->setData('departments', $departments);
        $this->setData('categories', $categories);

        $this->addView('Department/DepartmentsIndex');

        $this->useCollection(DepartmentResourceCollection::class, 'departments');

        return $this->response();

    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(Department $department)
    {
        $this->authorize('view', $department);
      
        $department->load(['categories', 'agents']);
        $agents = $this->userRepository->where('type','agent')->whereNotIn('id', $department->agents->pluck('id'))->get();

        $this->setData('department', $department);
        $this->setData('agents', $agents);

        $this->addView('Department/DepartmentsShow');

        $this->useCollection(DepartmentResource::class, 'department');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(Department $department = null)
    {
        if($department){
            $this->authorize('update', $department);
            $department->load(['categories']);
        }else{
            $this->authorize('create', $this->departmentRepository->getModel());
        }

        $categories = $this->categoryRepository->where('type', 'tickets')->get();

        $this->setData('department', $department);
        $this->setData('categories', $categories);

        $this->addView('Department/DepartmentsCreate');

        $this->useCollection(DepartmentResource::class, 'department');

        return $this->response();
    }

    /**
     * Create New Department.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(DepartmentFormRequest $request, Department $department = null)
    {
        $validated = $request->validated();

        if($request instanceof DepartmentUpdateFormRequest){
            $department->update($validated);
            if(!empty($validated['image'])){
                $department->clearMediaCollection('image');
                $department->addMedia($validated['image'])->toMediaCollection('image');
            }
            $message = 'Department Updated Successfully';
         }else{
            $department = $this->departmentRepository->create($validated);
            $department->addMedia($validated['image'])->toMediaCollection('image');
            $message = 'Department Created Successfully';
        }

        $department->categories()->detach();
        $department->categories()->attach($validated['categories']);

        
        $this->flashMessage('success', $message);

        $this->setData('department', $department, 'api');

        $this->useCollection(DepartmentResource::class, 'department');

        $this->redirectRoute('departments.show', $department->id);

        return $this->response();
    }

    
    /**
     * Create New Department.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $this->authorize('delete', $department);

        $department->agents()->detach();

        $this->departmentRepository->remove($department);

        $this->setData('department', $department);

        $this->useCollection(DepartmentResource::class, 'department');

        $this->redirectRouteWithQueryParams('departments.index');
        
        return $this->response();
    } 
    
    /**
    * Create New Department.
    *
    * @return \Illuminate\Http\Response
    */
   public function assignAgents(DepartmentAgentsFormRequest $request, Department $department)
   {
       $agent = $department->agents()->attach($request->validated()['agents']);

       $this->flashMessage('success', 'Agents assigned Successfully.');

       $this->setData('agent', $agent);

       $this->useCollection(UserResource::class, 'agent');

       $this->redirectRouteWithQueryParams('departments.show', $department->id);
        
       return $this->response();
   }

    /**
     * Create New Department.
     *
     * @return \Illuminate\Http\Response
     */
    public function deassignAgents(DepartmentAgentsFormRequest $request, Department $department)
    {
        $department->agents()->wherePivotIn('agent_id', $request->validated())->detach();
 
        $this->flashMessage('success', 'Agent deassigned Successfully.');

        $this->setApiResponse(function(){
            return response()->json([
                'detached'=>true
            ]);
        });
 
        $this->redirectRouteWithQueryParams('departments.show', $department->id);

        return $this->response();
    }
}