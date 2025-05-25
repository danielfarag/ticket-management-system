<?php

namespace App\Domain\Website\Http\Controllers;

use App\Domain\Cms\Entities\Article;
use App\Domain\Cms\Http\Resources\Article\ArticleResource;
use App\Domain\Cms\Http\Resources\Article\ArticleResourceCollection;
use Illuminate\Http\Request;
use App\Domain\Cms\Repositories\Contracts\ArticleRepository;
use App\Domain\General\Entities\Comment;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\General\Repositories\Contracts\CommentRepository;
use App\Domain\General\Repositories\Contracts\CategoryRepository;
use App\Domain\General\Http\Requests\Comment\CommentStoreFormRequest;
use App\Domain\General\Http\Resources\Comment\CommentResource;

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
     * @var CommentRepository
     */
    private $commentRepository;
    
    /**
     * initialize articleRepository
     */
    public function __construct()
    {
        $this->articleRepository = app()->make(ArticleRepository::class);
        $this->categoryRepository = app()->make(CategoryRepository::class);
        $this->commentRepository = app()->make(CommentRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $this->categoryRepository->orderBy('id')->where(['type'=>'articles', 'status'=>'active'])->get();
        
        $recent_articles = $this->articleRepository->orderBy('id')->take(10)->get();
        $popular_articles = $this->articleRepository->getModel()->orderByViews()->take(9)->get();
        $helpful_articles = $this->articleRepository->take(8)->get();

        $this->setData('categories', $categories);
        $this->setData('recent_articles', $recent_articles);
        $this->setData('popular_articles', $popular_articles);
        $this->setData('helpful_articles', $helpful_articles);

        $this->addView('Website/Knowledge/KnowledgeIndex');

        $this->setApiResponse(function() use($categories, $recent_articles, $popular_articles, $helpful_articles){
            return response()->json([
                'categories'=>$categories,
                'recent_articles'=>$recent_articles,
                'popular_articles'=>$popular_articles,
                'helpful_articles'=>$helpful_articles,
            ]);
        });

        return $this->response();
    }

    
    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $key= $request->query('key');

        $articles = $this->articleRepository->where('title','Like','%'.$key.'%')->orWhere('body','Like','%'.$key.'%')->get();

        $this->setData('articles', $articles);

        $this->useCollection(ArticleResourceCollection::class, 'articles');
        
        $this->addView('Website/Knowledge/KnowledgeSearch');
        
        return $this->response();
    }
    
    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function category(Request $request, $id)
    {
        $articles = $this->articleRepository->whereHas('categories',function($q) use($id) {
            return $q->where('category_id', $id);
        })->get();
        
        $categories = $this->categoryRepository->orderBy('id')->where('type','articles')->get();

        $this->setData('articles', $articles);
        $this->setData('categories', $categories);

        $this->useCollection(ArticleResourceCollection::class, 'articles');
        
        $this->addView('Website/Knowledge/KnowledgeCategory');
        
        return $this->response();
    }
    
    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Article $article)
    {
        $article->load(['comments.user', 'author']);

        views($article)->cooldown(now()->addSeconds(20))->record();

        $this->setData('article', $article);

        $this->useCollection(ArticleResource::class, 'article');
        
        $this->addView('Website/Knowledge/KnowledgeShow');
        
        return $this->response();
    }
    
    
    /**
     * Create Comment.
     *
     * @return \Illuminate\Http\Response
     */
    public function createComment(CommentStoreFormRequest $request, Article $article)
    {
        $comment = $article->comments()->create($request->validated());

        $this->flashMessage('success', 'Comment Created Successfully.');
        
        $this->setData('comment', $comment);

        $this->useCollection(CommentResource::class, 'comment');

        $this->redirectRouteWithQueryParams('knowledge.show', $article->id);
        
        return $this->response();
    }

    /**
     * Create Comment.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteComment(Comment $comment)
    {
        $article_id = $comment->commentable->id;

        $this->commentRepository->remove($comment);

        $this->setData('comment', $comment);

        $this->useCollection(CommentResource::class, 'comment');

        $this->redirectRouteWithQueryParams('knowledge.show', $article_id);
        
        return $this->response();
    }

    /**
     * Create Comment.
     *
     * @return \Illuminate\Http\Response
     */
    public function setUseful(Request $request, Article $article)
    {
        $request->validate([
            'up'  => ['required', 'boolean']
        ]);

        $this->articleRepository->setUseful($request, $article);

        $this->flashMessage('success', 'Updated. Thanks for your contribution.');
        
        $this->setData('article', $article);

        $this->useCollection(ArticleResource::class, 'article');

        $this->redirectRouteWithQueryParams('knowledge.show', $article->id);
        
        return $this->response();
    }
}