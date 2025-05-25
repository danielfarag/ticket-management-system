<?php

namespace App\Domain\Ticket\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Ticket\Entities\Severity;
use App\Domain\Ticket\Http\Resources\Severity\SeverityResource;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\Ticket\Repositories\Contracts\SeverityRepository;
use App\Domain\Ticket\Criteria\Severity\SeveritySortedByCriteria;
use App\Domain\Ticket\Http\Requests\Severity\SeverityFormRequest;
use App\Domain\Ticket\Criteria\Severity\SeverityFiltrationCriteria;
use App\Domain\Ticket\Http\Requests\Severity\SeverityUpdateFormRequest;
use App\Domain\Ticket\Http\Resources\Severity\SeverityResourceCollection;

class SeverityController extends BaseController
{
    /**
     * @var SeverityRepository
     */
    private $severityRepository;

    /**
     */
    public function __construct()
    {
        $this->severityRepository = app()->make(SeverityRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->severityRepository->getModel());
     
        $this->severityRepository->pushCriteria(SeveritySortedByCriteria::class);
        $this->severityRepository->pushCriteria(SeverityFiltrationCriteria::class);

        $severities = $this->severityRepository->paginate()->withQueryString();

        $this->setData('severities', $severities);

        $this->addView('Severity/SeveritiesIndex');

        $this->useCollection(SeverityResourceCollection::class, 'severities');

        return $this->response();

    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(Severity $severity)
    {
        $this->authorize('view', $severity);

        $this->setData('severity', $severity);

        $this->addView('Severity/SeveritiesShow');

        $this->useCollection(SeverityResource::class, 'severity');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(Severity $severity = null)
    {
        if($severity){
            $this->authorize('update', $severity);
        }else{
            $this->authorize('create', $this->severityRepository->getModel());
        }

        $this->setData('severity', $severity);

        $this->addView('Severity/SeveritiesCreate');

        $this->useCollection(SeverityResource::class, 'severity');

        return $this->response();
    }

    /**
     * Create New Severity.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(SeverityFormRequest $request, Severity $severity = null)
    {
        $validated = $request->validated();

        if($request instanceof SeverityUpdateFormRequest){
            $severity->update($validated);
            $message = 'Severity Updated Successfully';
         }else{
            $severity = $this->severityRepository->create($validated);
            $message = 'Severity Created Successfully';
        }
        
        $this->flashMessage('success', $message);

        $this->setData('severity', $severity, 'api');

        $this->useCollection(DepartmentResource::class, 'severity');

        $this->redirectRoute('severities.show', $severity->id);

        return $this->response();
    }

    
    /**
     * Create New Severity.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Severity $severity)
    {
        $this->authorize('delete', $severity);

        $this->severityRepository->remove($severity);

        $this->setData('severity', $severity);

        $this->useCollection(SeverityResource::class, 'severity');

        $this->redirectRouteWithQueryParams('severities.index');
        
        return $this->response();
    }

}