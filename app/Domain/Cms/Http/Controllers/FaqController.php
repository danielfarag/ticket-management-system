<?php

namespace App\Domain\Cms\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Cms\Entities\Faq;
use App\Domain\Cms\Http\Resources\Faq\FaqResource;
use App\Domain\Cms\Criteria\Faq\FaqSortedByCriteria;
use App\Domain\Cms\Http\Requests\Faq\FaqFormRequest;
use App\Domain\Cms\Criteria\Faq\FaqFiltrationCriteria;
use App\Domain\Cms\Repositories\Contracts\FaqRepository;
use App\Domain\Cms\Http\Requests\Faq\FaqUpdateFormRequest;
use App\Domain\Cms\Http\Resources\Faq\FaqResourceCollection;
use App\Domain\Cms\Repositories\Contracts\ArticleRepository;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\Ticket\Repositories\Contracts\DepartmentRepository;

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
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     */
    public function __construct()
    {
        $this->faqRepository = app()->make(FaqRepository::class);
        $this->departmentRepository = app()->make(DepartmentRepository::class);
        $this->articleRepository = app()->make(ArticleRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->faqRepository->getModel());
     
        $this->faqRepository->pushCriteria(FaqSortedByCriteria::class);
        $this->faqRepository->pushCriteria(FaqFiltrationCriteria::class);

        $faqs = $this->faqRepository->view()->paginate()->withQueryString();

        $this->setData('faqs', $faqs);

        $this->addView('Faq/FaqsIndex');

        $this->useCollection(FaqResourceCollection::class, 'faqs');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(Faq $faq)
    {
        $this->authorize('view', $faq);

        $faq->load(['department', 'article']);

        $this->setData('faq', $faq);

        $this->addView('Faq/FaqsShow');

        $this->useCollection(FaqResource::class, 'faq');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(Faq $faq = null)
    {
        if($faq){
            $this->authorize('update', $faq);
            $faq->load(['department', 'article']);
        }else{
            $this->authorize('create', $this->faqRepository->getModel());
        }

        $departments = $this->departmentRepository->all();
        $articles = $this->articleRepository->all();

        $this->setData('faq', $faq);
        $this->setData('articles', $articles);
        $this->setData('departments', $departments);


        $this->addView('Faq/FaqsCreate');

        $this->useCollection(FaqResource::class, 'faq');

        return $this->response();
    }

    /**
     * Create New Faq.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(FaqFormRequest $request, Faq $faq = null)
    {
        $validated = $request->validated();

        if($request instanceof FaqUpdateFormRequest){
            $faq->update($validated);
            $message = 'Faq Updated Successfully';
         }else{
            $faq = $this->faqRepository->create($validated);
            $message = 'Faq Created Successfully';
        }
        
        $this->flashMessage('success', $message);

        $this->setData('faq', $faq, 'api');

        $this->useCollection(FaqResource::class, 'faq');

        $this->redirectRoute('faqs.show', $faq->id);

        return $this->response();
    }

    
    /**
     * Delete New Faq.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $this->authorize('delete', $faq);

        $this->faqRepository->remove($faq);

        $this->setData('faq', $faq);

        $this->useCollection(FaqResource::class, 'faq');

        $this->redirectRouteWithQueryParams('faqs.index');
        
        return $this->response();
    }

}