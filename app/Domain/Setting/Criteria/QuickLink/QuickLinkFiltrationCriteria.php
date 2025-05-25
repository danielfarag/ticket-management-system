<?php

namespace App\Domain\Setting\Criteria\QuickLink;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class QuickLinkFiltrationCriteria implements CriteriaInterface
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
        $url = request()->query('url',false);  
        $priority = request()->query('priority',false);  
        $created_at = request()->query('created_at',false);
		$updated_at = request()->query('updated_at',false);
		
        
        return $model
        ->when($id,function($q) use($id){
            return $q->where('id', $id);
        })
		->when($title,function($q) use($title){
            return $q->where('title', $title);
        })
		->when($url,function($q) use($url){
            return $q->where('url', $url);
        })
		->when($priority,function($q) use($priority){
            return $q->where('priority', $priority);
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
