<?php

namespace App\Domain\Cms\Criteria\Article;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class ArticleFiltrationCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param object              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $id = request()->query('id',false);

		$title = request()->query('title',false);
		$author_name = request()->query('author_name',false);
		$status = request()->query('status',false);
		$created_at = request()->query('created_at',false);
		$updated_at = request()->query('updated_at',false);
		
        
        return $model
        ->when($id,function($q) use($id){
            return $q->where('id', $id);
        })
        ->when($title,function($q) use($title){
            return $q->where('title','LIKE','%'. $title .'%');
        })
        ->when($author_name,function($q) use($author_name){
            return $q->where('author_name','LIKE','%'. $author_name .'%');
        })
		->when($status,function($q) use($status){
            $statuses = !is_array($status) ? [$status] : $status;
          
            return $q->whereIn('status', $statuses);
        })
		->when($created_at,function($q) use($created_at){
            if(is_array($created_at)){
                return $q->whereBetween('created_at', $created_at);
            }else{
                return $q->whereDate('created_at', $created_at);
            }
        })
		->when($updated_at,function($q) use($updated_at){
            if(is_array($updated_at)){
                return $q->whereBetween('updated_at', $updated_at);
            }else{
                return $q->whereDate('updated_at', $updated_at);
            }
        })
		;
    }
}
