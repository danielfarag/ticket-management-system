<?php

namespace App\Domain\Cms\Repositories\Eloquent;

use App\Domain\Cms\Entities\Article;
use App\Domain\Cms\Entities\Views\ArticleView;
use App\Domain\Cms\Repositories\Contracts\ArticleRepository;
use App\Infrastructure\AbstractRepositories\EloquentRepository;
use Illuminate\Http\Request;

/**
 * Class ArticleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ArticleRepositoryEloquent extends EloquentRepository implements ArticleRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Article::class;

    /**
     * View Name
     * @var String
     */
    protected $view_class = ArticleView::class;


    /**
     * Set current article useful
     *
     * @param Request $request
     * @param Article $article
     * @return boolean
     */
    public function setUseful(Request $request, Article $article){
        $up = $request->input('up');

        $user = $article->users()->where('user_id', auth()->id())->first();

        if($user){
            if($user->pivot->up == $up){
                $user->pivot->delete();
            }else{
                $user->pivot->update(['up'=>$up]);
            }
        }else{
            $article->users()->attach(auth()->id(), $request->only('up'));
        }
    }
}