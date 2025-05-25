<?php

namespace App\Domain\Cms\Criteria\Faq;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class FaqFiltrationCriteria implements CriteriaInterface
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
		$question = request()->query('question',false);
		$answer = request()->query('answer',false);
		$status = request()->query('status',false);
		$department_name = request()->query('department_name',false);
		$article_title = request()->query('article_title',false);
		$created_at = request()->query('created_at',false);
		$updated_at = request()->query('updated_at',false);
		
        
        return $model
        ->when($id,function($q) use($id){
            return $q->where('id', $id);
        })
        ->when($question,function($q) use($question){
            return $q->where('question','LIKE','%'. $question .'%');
        })
        ->when($answer,function($q) use($answer){
            return $q->where('answer','LIKE','%'. $answer .'%');
        })
        ->when($department_name,function($q) use($department_name){
            return $q->where('department_name', 'LIKE', '%'.$department_name.'%');
        })
        ->when($article_title,function($q) use($article_title){
            return $q->where('article_title', 'LIKE', '%'.$article_title.'%');
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
