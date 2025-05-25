<?php

namespace App\Domain\Website\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Cms\Repositories\Contracts\FaqRepository;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\Ticket\Repositories\Contracts\DepartmentRepository;
use App\Domain\Cms\Http\Resources\Faq\FaqResourceCollection;

class FaqController extends BaseController
{
    /**
     * @var FaqRepository
     */
    private $faqRepository;

    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * initialize faqRepository
     */
    public function __construct()
    {
        $this->faqRepository = app()->make(FaqRepository::class);
        $this->departmentRepository = app()->make(DepartmentRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $departments = $this->departmentRepository->has('faqs')->active()->orderBy('id')->get();

        if($departments->count() == 0){
            return redirect()->route('home');
        }

        $department = $departments->where('id', $id)->first();

        if(!$department){
            $department = $departments->first();
            return redirect()->route('faqs.department', $department->id);
        }

        $faqs = $this->faqRepository->where('department_id', $department->id)->get();

        $this->setData('faqs', $faqs);
        $this->setData('departments', $departments);
        $this->setData('department', $department);
        
        $this->addView('Website/Faq/FaqCategory');

        $this->useCollection(FaqResourceCollection::class, 'faqs');

        return $this->response();
    }

    
    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $key = $request->query('key');

        $faqs = $this->faqRepository->where('question','Like','%'.$key.'%')->orWhere('answer','Like','%'.$key.'%')->get();

        $this->setData('faqs', $faqs);

        $this->addView('Website/Faq/FaqSearch');

        $this->useCollection(FaqResourceCollection::class, 'faqs');

        return $this->response();
    }
}