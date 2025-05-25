<?php

namespace App\Domain\Setting\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Setting\Criteria\BlockIp\BlockIpSortedByCriteria;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\Setting\Http\Requests\BlockIp\BlockIpFormRequest;
use App\Domain\Setting\Repositories\Contracts\BlockIpRepository;
use App\Domain\Setting\Criteria\BlockIp\BlockIpFiltrationCriteria;
use App\Domain\Setting\Entities\BlockIp;
use App\Domain\Setting\Http\Requests\BlockIp\BlockIpUpdateFormRequest;
use App\Domain\Setting\Http\Resources\BlockIp\BlockIpResource;
use App\Domain\Setting\Http\Resources\BlockIp\BlockIpResourceCollection;

class BlockIpController extends BaseController
{
    /**
     * @var BlockIpRepository
     */
    private $blockIpRepository;

    /**
     */
    public function __construct()
    {
        $this->blockIpRepository = app()->make(BlockIpRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->blockIpRepository->getModel());
     
        $this->blockIpRepository->pushCriteria(BlockIpSortedByCriteria::class);
        $this->blockIpRepository->pushCriteria(BlockIpFiltrationCriteria::class);

        $blockIps = $this->blockIpRepository->view()->paginate()->withQueryString();

        $this->setData('blockIps', $blockIps);

        $this->addView('BlockIp/BlockIpsIndex');

        $this->useCollection(BlockIpResourceCollection::class, 'blockIps');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(BlockIp $block_ip)
    {
        $this->authorize('view', $block_ip);

        $block_ip->load(['blocker']);

        $this->setData('blockIp', $block_ip);

        $this->addView('BlockIp/BlockIpsShow');

        $this->useCollection(BlockIpResource::class, 'blockIp');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(BlockIp $block_ip = null)
    {
        if($block_ip){
            $this->authorize('update', $block_ip);
        }else{
            $this->authorize('create', $this->blockIpRepository->getModel());
        }

        $this->setData('blockIp', $block_ip);

        $this->addView('BlockIp/BlockIpsCreate');

        $this->useCollection(BlockIpResource::class, 'blockIp');

        return $this->response();
    }

    /**
     * Create New BlockIp.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(BlockIpFormRequest $request, BlockIp $block_ip = null)
    {
        $validated = $request->validated();

        if($request instanceof BlockIpUpdateFormRequest){
            $block_ip->update($validated);
            $message = 'BlockIp Updated Successfully';
         }else{
            $block_ip = $this->blockIpRepository->create($validated);
            $message = 'BlockIp Created Successfully';
        }

        $this->flashMessage('success', $message);

        $this->setData('blockIp', $block_ip, 'api');

        $this->useCollection(BlockIpResource::class, 'blockIp');

        $this->redirectRoute('block_ips.show', $block_ip->id);

        return $this->response();
    }

    
    /**
     * Create New BlockIp.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlockIp $block_ip)
    {
        $this->authorize('delete', $block_ip);

        $this->blockIpRepository->remove($block_ip);

        $this->setData('blockIp', $block_ip);

        $this->useCollection(BlockIpResource::class, 'blockIp');

        $this->redirectRouteWithQueryParams('block_ips.index');
        
        return $this->response();
    } 
}