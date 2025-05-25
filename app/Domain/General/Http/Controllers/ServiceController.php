<?php

namespace App\Domain\General\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\General\Entities\Service;
use App\Domain\General\Http\Resources\Service\ServiceResource;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\General\Criteria\Service\ServiceSortedByCriteria;
use App\Domain\General\Http\Requests\Service\ServiceFormRequest;
use App\Domain\General\Repositories\Contracts\ServiceRepository;
use App\Domain\General\Criteria\Service\ServiceFiltrationCriteria;
use App\Domain\General\Http\Requests\Service\ServiceUpdateFormRequest;
use App\Domain\General\Http\Resources\Service\ServiceResourceCollection;

class ServiceController extends BaseController
{
    /**
     * @var ServiceRepository
     */
    private $serviceRepository;

    /**
     */
    public function __construct()
    {
        $this->serviceRepository = app()->make(ServiceRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->serviceRepository->getModel());
      
        $this->serviceRepository->pushCriteria(ServiceSortedByCriteria::class);
        $this->serviceRepository->pushCriteria(ServiceFiltrationCriteria::class);

        $services = $this->serviceRepository->paginate()->withQueryString();

        $this->setData('services', $services);

        $this->addView('Service/ServicesIndex');

        $this->useCollection(ServiceResourceCollection::class, 'services');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(Service $service)
    {
        $this->authorize('view', $service);

        $this->setData('service', $service);

        $this->addView('Service/ServicesShow');

        $this->useCollection(ServiceResource::class, 'service');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(Service $service = null)
    {
        if($service){
            $this->authorize('update', $service);
        }else{
            $this->authorize('create', $this->serviceRepository->getModel());
        }

        $this->setData('service', $service);

        $this->addView('Service/ServicesCreate');

        $this->useCollection(ServiceResource::class, 'service');

        return $this->response();
    }

    /**
     * Create New Service.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(ServiceFormRequest $request, Service $service = null)
    {
        $validated = $request->validated();

        if($request instanceof ServiceUpdateFormRequest){
            $service->update($validated);
            $message = 'Service Updated Successfully';
         }else{
            $service = $this->serviceRepository->create($validated);
            $message = 'Service Created Successfully';
        }

        $this->flashMessage('success', $message);

        $this->setData('service', $service, 'api');

        $this->useCollection(ArticleResource::class, 'service');

        $this->redirectRoute('services.show', $service->id);

        return $this->response();
    }

    
    /**
     * Create New Service.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);

        $this->serviceRepository->remove($service);

        $this->setData('service', $service);

        $this->useCollection(ServiceResource::class, 'service');

        $this->redirectRouteWithQueryParams('services.index');
        
        return $this->response();
    } 
    
}