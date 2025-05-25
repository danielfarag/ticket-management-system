<?php

namespace App\Domain\Cms\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Cms\Entities\Article;
use App\Domain\Cms\Criteria\Article\ArticleSortedByCriteria;
use App\Domain\Cms\Http\Requests\Article\ArticleFormRequest;
use App\Domain\Cms\Repositories\Contracts\ArticleRepository;
use App\Domain\Cms\Criteria\Article\ArticleFiltrationCriteria;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\General\Repositories\Contracts\CategoryRepository;
use App\Domain\Cms\Http\Requests\Article\ArticleUpdateFormRequest;
use App\Domain\Cms\Http\Resources\Article\ArticleResource;
use App\Domain\Cms\Http\Resources\Article\ArticleResourceCollection;

class ArticleController extends BaseController
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    
    /**
     */
    public function __construct()
    {
        $this->articleRepository = app()->make(ArticleRepository::class);
        $this->categoryRepository = app()->make(CategoryRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->articleRepository->getModel());
      
        $this->articleRepository->pushCriteria(ArticleSortedByCriteria::class);
        $this->articleRepository->pushCriteria(ArticleFiltrationCriteria::class);

        $articles = $this->articleRepository->view()->paginate()->withQueryString();

        $this->setData('articles', $articles);

        $this->addView('Article/ArticlesIndex');

        $this->useCollection(ArticleResourceCollection::class, 'articles');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(Article $article)
    {
        $this->authorize('view', $article);

        $article->load('author');

        $this->setData('article', $article);

        $this->addView('Article/ArticlesShow');

        $this->useCollection(ArticleResource::class, 'article');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(Article $article = null)
    {
        if($article){
            $this->authorize('update', $article);
        }else{
            $this->authorize('create', $this->articleRepository->getModel());
        }

        $categories = $this->categoryRepository->where('type', 'articles')->get();

        $this->setData('article', $article);

        $this->setData('categories', $categories);

        $this->addView('Article/ArticlesCreate');

        $this->useCollection(ArticleResource::class, 'article');

        return $this->response();
    }

    /**
     * Create New Article.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(ArticleFormRequest $request, Article $article = null)
    {
        $validated = $request->validated();

        if($request instanceof ArticleUpdateFormRequest){
            $article->update($validated);
            if(!empty($validated['image'])){
                $article->clearMediaCollection('image');
                $article->addMedia($validated['image'])->toMediaCollection('image');
            }
            $message = 'Article Updated Successfully';
         }else{
            $validated['author_id'] = auth()->id();
            $article = $this->articleRepository->create($validated);
            $article->addMedia($validated['image'])->toMediaCollection('image');
            $message = 'Article Created Successfully';
        }

        $article->categories()->detach();
        $article->categories()->attach($validated['category_id']);

        $this->flashMessage('success', $message);

        $this->setData('article', $article, 'api');

        $this->useCollection(ArticleResource::class, 'article');

        $this->redirectRoute('articles.show', $article->id);

        return $this->response();
    }

    
    /**
     * Create New Article.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->categories()->detach();

        $this->articleRepository->remove($article);

        $this->setData('article', $article);

        $this->useCollection(ArticleResource::class, 'article');

        $this->redirectRouteWithQueryParams('articles.index');
        
        return $this->response();
    }

}