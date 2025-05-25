<?php

namespace App\Domain\Website\Http\Controllers;

use App\Domain\Cms\Repositories\Contracts\FaqRepository;
use App\Domain\General\Repositories\Contracts\SliderRepository;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\Ticket\Repositories\Contracts\DepartmentRepository;

class HomeController extends BaseController
{
    /**
     * @var SliderRepository
     */
    private $sliderRepository;
    
    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * @var FaqRepository
     */
    private $faqRepository;

    /**
     * initialize sliderRepository
     */
    public function __construct()
    {
        $this->sliderRepository = app()->make(SliderRepository::class);
        $this->departmentRepository = app()->make(DepartmentRepository::class);
        $this->faqRepository = app()->make(FaqRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = $this->sliderRepository->where('status', 'active')->get();
        $departments = $this->departmentRepository->where('status', 'active')->get();
        $faqs = $this->faqRepository->whereNotNull('article_id')->where('status', 'active')->get();
       
        $this->setData('slides', $slides);
        $this->setData('departments', $departments);
        $this->setData('faqs', $faqs);

        $this->addView('Website/Home');

        $this->setApiResponse(function() use($slides, $departments, $faqs){
            return response()->json([
                'slides'=>$slides,
                'departments'=>$departments,
                'faqs'=>$faqs,
            ]);
        });

        return $this->response();

    }
}