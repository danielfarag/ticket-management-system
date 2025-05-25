<?php

namespace App\Domain\Setting\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Setting\Criteria\QuickLink\QuickLinkSortedByCriteria;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\Setting\Repositories\Contracts\QuickLinkRepository;
use App\Domain\Setting\Http\Requests\QuickLink\QuickLinkFormRequest;
use App\Domain\Setting\Criteria\QuickLink\QuickLinkFiltrationCriteria;
use App\Domain\Setting\Entities\QuickLink;
use App\Domain\Setting\Http\Requests\QuickLink\QuickLinkUpdateFormRequest;
use App\Domain\Setting\Http\Resources\QuickLink\QuickLinkResource;
use App\Domain\Setting\Http\Resources\QuickLink\QuickLinkResourceCollection;

class QuickLinkController extends BaseController
{
    /**
     * @var QuickLinkRepository
     */
    private $quickLinkRepository;

    /**
     */
    public function __construct()
    {
        $this->quickLinkRepository = app()->make(QuickLinkRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->quickLinkRepository->getModel());

        $this->quickLinkRepository->pushCriteria(QuickLinkSortedByCriteria::class);
        $this->quickLinkRepository->pushCriteria(QuickLinkFiltrationCriteria::class);

        $quickLinks = $this->quickLinkRepository->paginate()->withQueryString();
        
        $this->setData('quickLinks', $quickLinks);

        $this->addView('QuickLink/QuickLinksIndex');

        $this->useCollection(QuickLinkResourceCollection::class, 'quickLinks');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(QuickLink $quick_link)
    {
        $this->authorize('view', $quick_link);

        $this->setData('quickLink', $quick_link);

        $this->addView('QuickLink/QuickLinksShow');

        $this->useCollection(QuickLinkResource::class, 'quickLink');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(QuickLink $quick_link = null)
    {
        if($quick_link){
            $this->authorize('update', $quick_link);
        }else{
            $this->authorize('create', $this->quickLinkRepository->getModel());
        }

        $this->setData('quickLink', $quick_link);

        $this->addView('QuickLink/QuickLinksCreate');

        $this->useCollection(QuickLinkResource::class, 'quickLink');

        return $this->response();
    }

    /**
     * Create New QuickLink.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(QuickLinkFormRequest $request, QuickLink $quick_link = null)
    {
        $validated = $request->validated();

        if($request instanceof QuickLinkUpdateFormRequest){
            $quick_link->update($validated);
            $message = 'QuickLink Updated Successfully';
         }else{
            $quick_link = $this->quickLinkRepository->create($validated);
            $message = 'QuickLink Created Successfully';
        }

        $this->flashMessage('success', $message);

        $this->setData('quickLink', $quick_link, 'api');

        $this->useCollection(MemberResource::class, 'quickLink');

        $this->redirectRoute('quick_links.show', $quick_link->id);

        return $this->response();
    }

    
    /**
     * Create New QuickLink.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuickLink $quick_link)
    {
        $this->authorize('delete', $quick_link);

        $this->quickLinkRepository->remove($quick_link);

        $this->setData('quickLink', $quick_link);

        $this->useCollection(QuickLinkResource::class, 'quickLink');

        $this->redirectRouteWithQueryParams('quick_links.index');
        
        return $this->response();
    } 
}