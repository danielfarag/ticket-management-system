<?php

namespace App\Domain\Ticket\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Ticket\Entities\Status;
use App\Domain\Ticket\Criteria\Status\StatusSortedByCriteria;
use App\Domain\Ticket\Http\Requests\Status\StatusFormRequest;
use App\Domain\Ticket\Repositories\Contracts\StatusRepository;
use App\Domain\Ticket\Criteria\Status\StatusFiltrationCriteria;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\Ticket\Http\Requests\Status\StatusUpdateFormRequest;
use App\Domain\Ticket\Http\Resources\Status\StatusResource;
use App\Domain\Ticket\Http\Resources\Status\StatusResourceCollection;

class StatusController extends BaseController
{
    /**
     * @var StatusRepository
     */
    private $statusRepository;

    /**
     */
    public function __construct()
    {
        $this->statusRepository = app()->make(StatusRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->statusRepository->getModel());
        
        $this->statusRepository->pushCriteria(StatusSortedByCriteria::class);
        $this->statusRepository->pushCriteria(StatusFiltrationCriteria::class);

        $statuses = $this->statusRepository->paginate()->withQueryString();

        $this->setData('statuses', $statuses);

        $this->addView('Status/StatusesIndex');

        $this->useCollection(StatusResourceCollection::class, 'statuses');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(Status $status)
    {
        $this->authorize('view', $status);

        $this->setData('status', $status);

        $this->addView('Status/StatusesShow');

        $this->useCollection(StatusResource::class, 'status');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(Status $status = null)
    {      
        if($status){
            $this->authorize('update', $status);
        }else{
            $this->authorize('create', $this->statusRepository->getModel());
        }

        $this->setData('status', $status);

        $this->addView('Status/StatusesCreate');

        $this->useCollection(StatusResource::class, 'status');

        return $this->response();
    }

    /**
     * Create New Status.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(StatusFormRequest $request, Status $status = null)
    {
        $validated = $request->validated();

        if($request instanceof StatusUpdateFormRequest){
            $status->update($validated);
            $message = 'Status Updated Successfully';
         }else{
            $status = $this->statusRepository->create($validated);
            $message = 'Status Created Successfully';
        }
        
        $this->flashMessage('success', $message);

        $this->setData('status', $status, 'api');

        $this->useCollection(StatusResource::class, 'status');

        $this->redirectRoute('statuses.show', $status->id);

        return $this->response();
    }

    
    /**
     * Create New Status.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $this->authorize('delete', $status);

        $this->statusRepository->remove($status);

        $this->setData('status', $status);

        $this->useCollection(StatusResource::class, 'status');

        $this->redirectRouteWithQueryParams('statuses.index');
        
        return $this->response();
    }

}