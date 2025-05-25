<?php

namespace App\Domain\Ticket\Criteria\Department;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class DepartmentFiltrationCriteria implements CriteriaInterface
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
		$name = request()->query('name',false);
        $status = request()->query('status',false);  
        $categories = request()->query('categories',false);  
        $created_at = request()->query('created_at',false);
		$updated_at = request()->query('updated_at',false);
		
        
        return $model
        ->when($id,function($q) use($id){
            return $q->where('id', $id);
        })
		->when($name,function($q) use($name){
            return $q->where('name', $name);
        })
        ->when($status,function($q) use($status){
            $statuses = !is_array($status) ? [$status] : $status;
          
            return $q->whereIn('status', $statuses);
        })
        ->when($categories,function($q) use($categories){
            $categories = !is_array($categories) ? [$categories] : $categories;
            return $q->where(function($q) use($categories){
                foreach ($categories as $category) {
                    $q->orWhere('categories', 'LIKE', '%'.$category.'%');
                }
            });
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
