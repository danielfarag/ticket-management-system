<?php

namespace App\Domain\General\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\General\Entities\Slider;
use App\Domain\General\Http\Resources\Slider\SliderResource;
use App\Domain\General\Criteria\Slider\SliderSortedByCriteria;
use App\Domain\General\Http\Requests\Slider\SliderFormRequest;
use App\Domain\General\Repositories\Contracts\SliderRepository;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\General\Criteria\Slider\SliderFiltrationCriteria;
use App\Domain\General\Http\Requests\Slider\SliderUpdateFormRequest;
use App\Domain\General\Http\Resources\Slider\SliderResourceCollection;

class SliderController extends BaseController
{
    /**
     * @var SliderRepository
     */
    private $sliderRepository;

    /**
     */
    public function __construct()
    {
        $this->sliderRepository = app()->make(SliderRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->sliderRepository->getModel());
     
        $this->sliderRepository->pushCriteria(SliderSortedByCriteria::class);
        $this->sliderRepository->pushCriteria(SliderFiltrationCriteria::class);

        $sliders = $this->sliderRepository->paginate()->withQueryString();

        $this->setData('sliders', $sliders);

        $this->addView('Slider/SlidersIndex');

        $this->useCollection(SliderResourceCollection::class, 'sliders');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(Slider $slider)
    {
        $this->authorize('view', $slider);

        $this->setData('slider', $slider);

        $this->addView('Slider/SlidersShow');

        $this->useCollection(SliderResource::class, 'slider');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(Slider $slider = null)
    {
        if($slider){
            $this->authorize('update', $slider);
        }else{
            $this->authorize('create', $this->sliderRepository->getModel());
        }

        $this->setData('slider', $slider);

        $this->addView('Slider/SlidersCreate');

        $this->useCollection(SliderResource::class, 'slider');

        return $this->response();
    }

    /**
     * Create New Slider.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(SliderFormRequest $request, Slider $slider = null)
    {
        $validated = $request->validated();

        if($request instanceof SliderUpdateFormRequest){
            $slider->update($validated);
            if(!empty($validated['image'])){
                $slider->clearMediaCollection('image');
                $slider->addMedia($validated['image'])->toMediaCollection('image');
            }
            $message = 'Slider Updated Successfully';
         }else{
            $slider = $this->sliderRepository->create($validated);
            $slider->addMedia($validated['image'])->toMediaCollection('image');
            $message = 'Slider Created Successfully';
        }

        $this->flashMessage('success', $message);

        $this->setData('slider', $slider, 'api');

        $this->useCollection(SliderResource::class, 'slider');

        $this->redirectRoute('sliders.show', $slider->id);

        return $this->response();
    }

    
    /**
     * Create New Slider.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $this->authorize('delete', $slider);

        $this->sliderRepository->remove($slider);

        $this->setData('slider', $slider);

        $this->useCollection(SliderResource::class, 'slider');

        $this->redirectRouteWithQueryParams('sliders.index');
        
        return $this->response();
    } 
    
}