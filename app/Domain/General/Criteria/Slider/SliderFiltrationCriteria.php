<?php

namespace App\Domain\General\Criteria\Slider;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class SliderFiltrationCriteria implements CriteriaInterface
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

		$subtitle = request()->query('subtitle',false);
		$title = request()->query('title',false);
		$button = request()->query('button',false);
		$link = request()->query('link',false);
		$status = request()->query('status',false);
		$created_at = request()->query('created_at',false);
		$updated_at = request()->query('updated_at',false);
		
        
        return $model
        ->when($id,function($q) use($id){
            return $q->where('id', $id);
        })
		->when($subtitle,function($q) use($subtitle){
            return $q->where('subtitle','LIKE','%'. $subtitle .'%');
        })
        ->when($title,function($q) use($title){
            return $q->where('title','LIKE','%'. $title .'%');
        })
        ->when($button,function($q) use($button){
            return $q->where('button','LIKE','%'. $button .'%');
        })
        ->when($link,function($q) use($link){
            return $q->where('link','LIKE','%'. $link .'%');
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
