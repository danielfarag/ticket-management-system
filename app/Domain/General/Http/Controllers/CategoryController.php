<?php

namespace App\Domain\General\Http\Controllers;

use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\General\Repositories\Contracts\CategoryRepository;
use App\Domain\General\Criteria\Category\CategorySortedByCriteria;
use App\Domain\General\Http\Requests\Category\CategoryFormRequest;
use App\Domain\General\Criteria\Category\CategoryFiltrationCriteria;
use App\Domain\General\Entities\Category;
use App\Domain\General\Http\Requests\Category\CategoryUpdateFormRequest;
use App\Domain\General\Http\Resources\Category\CategoryResource;
use App\Domain\General\Http\Resources\Category\CategoryResourceCollection;

class CategoryController extends BaseController
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     */
    public function __construct()
    {
        $this->categoryRepository = app()->make(CategoryRepository::class);
    }

    /**
     * Create New Faq.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $this->authorize('manageCategories', $this->categoryRepository->getPolicyModel($type));

        $this->categoryRepository->pushCriteria(CategorySortedByCriteria::class);
        $this->categoryRepository->pushCriteria(CategoryFiltrationCriteria::class);

        $categories = $this->categoryRepository->where('type',$type)->paginate()->withQueryString();

        $this->setData('categories', $categories);

        $this->addView('Category/CategoriesIndex');

        $this->useCollection(CategoryResourceCollection::class, 'categories');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show($type, Category $category)
    {
        $category->type == $type ?: abort(404);
        
        $this->authorize('manageCategories', $this->categoryRepository->getPolicyModel($type));
     
        $this->setData('category', $category);

        $this->addView('Category/CategoriesShow');

        $this->useCollection(CategoryResource::class, 'category');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit($type, Category $category = null)
    {
        $this->authorize('manageCategories', $this->categoryRepository->getPolicyModel($type));

        $this->setData('category', $category);

        $this->addView('Category/CategoriesCreate');

        $this->useCollection(CategoryResource::class, 'category');

        return $this->response();
    }

    /**
     * Create New Service.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(CategoryFormRequest $request, $type, Category $category = null)
    {
        $validated = $request->validated();

        if($request instanceof CategoryUpdateFormRequest){
            $category->update($validated);
            $message = 'Category Updated Successfully';
         }else{
            $category = $this->categoryRepository->create($validated);
            $message = 'Category Created Successfully';
        }

        if(array_key_exists('icon', $validated) && !empty($validated['icon'])){
            $category->setMeta('icon', $validated['icon']);
        }
        
        $this->flashMessage('success', $message);

        $this->setData('category', $category, 'api');

        $this->useCollection(CategoryResource::class, 'category');

        $this->redirectRoute('categories.show', ['type'=>$type, 'category'=>$category->id]);

        return $this->response();
    }

    
    /**
     * Create New Service.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($type, Category $category)
    {
        $this->authorize('manageCategories', $this->categoryRepository->getPolicyModel($type));
        
        $this->categoryRepository->remove($category);

        $this->setData('category', $category);

        $this->useCollection(CategoryResource::class, 'category');

        $this->redirectRouteWithQueryParams('categories.index', ['type'=>$type]);
        
        return $this->response();
    } 
}