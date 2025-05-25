<?php
namespace App\Domain\General\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\General\Entities\todo;
use App\Domain\General\Http\Resources\Todo\TodoResource;
use App\Domain\General\Criteria\Todo\TodoSortedByCriteria;
use App\Domain\General\Http\Requests\Todo\TodoFormRequest;
use App\Domain\User\Repositories\Contracts\UserRepository;
use App\Domain\General\Criteria\Todo\TodoFiltrationCriteria;
use App\Domain\General\Repositories\Contracts\TodoRepository;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\General\Http\Requests\Todo\TodoUpdateFormRequest;
use App\Domain\General\Http\Resources\Todo\TodoResourceCollection;

class TodoController extends BaseController
{
    /**
     * @var TodoRepository
     */
    private $todoRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     */
    public function __construct()
    {
        $this->todoRepository = app()->make(TodoRepository::class);
        $this->userRepository = app()->make(UserRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->todoRepository->getModel());
      
        $this->todoRepository->pushCriteria(TodoSortedByCriteria::class);
        $this->todoRepository->pushCriteria(TodoFiltrationCriteria::class);

        $todos = $this->todoRepository->view()->paginate()->withQueryString();

        $this->setData('todos', $todos);

        $this->addView('Todo/TodoIndex');

        $this->useCollection(TodoResourceCollection::class, 'todos');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(Todo $todo)
    {
        $this->authorize('view', $todo);

        $todo->load('agent');
        
        $this->setData('todo', $todo);

        $this->addView('Todo/TodoShow');

        $this->useCollection(TodoResource::class, 'todo');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(Todo $todo = null)
    {
        if($todo){
            $this->authorize('update', $todo);
        }else{
            $this->authorize('create', $this->todoRepository->getModel());
        }

        $agents = $this->userRepository->where('type', 'agent')->get();

        $this->setData('todo', $todo);
        $this->setData('agents', $agents);

        $this->addView('Todo/TodoCreate');

        $this->useCollection(TodoResource::class, 'todo');

        return $this->response();

    }

    /**
     * Create New Todo.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(TodoFormRequest $request, Todo $todo = null)
    {
        $validated = $request->validated();

        if($request instanceof TodoUpdateFormRequest){
            $todo->update($validated);
            $message = 'Todo Updated Successfully';
         }else{
            $todo = $this->todoRepository->create($validated);
            $message = 'Todo Created Successfully';
        }
        
        $this->flashMessage('success', $message);

        $this->setData('todo', $todo, 'api');

        $this->useCollection(TodoResource::class, 'todo');

        $this->redirectRoute('todos.show', $todo->id);

        return $this->response();
    }

    
    /**
     * Create New Todo.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);

        $this->todoRepository->remove($todo);

        $this->setData('todo', $todo);

        $this->useCollection(TodoResource::class, 'todo');

        $this->redirectRouteWithQueryParams('todos.index');
        
        return $this->response();
    }

}