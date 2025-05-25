<?php

namespace App\Domain\Website\Http\Controllers;

use App\Domain\General\Repositories\Contracts\ServiceRepository;
use App\Infrastructure\Http\AbstractControllers\BaseController;

class FeatureController extends BaseController
{
    /**
     * @var ServiceRepository
     */
    private $serviceRepository;

    /**
     * initialize serviceRepository
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
    public function index()
    {
        $services = $this->serviceRepository->where('status', 'active')->get();

        $this->setData('services', $services);
        
        $this->addView('Website/Features');

        $this->setApiResponse(function() use($services){
            return response()->json([
                'services' => $services
            ]);
        });

        return $this->response();
    }
}