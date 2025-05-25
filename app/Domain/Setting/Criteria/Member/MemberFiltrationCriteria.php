<?php

namespace App\Domain\Setting\Criteria\Member;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class MemberFiltrationCriteria implements CriteriaInterface
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
		$title = request()->query('title',false);
		$description = request()->query('description',false);
		
        
        return $model
        ->when($id,function($q) use($id){
            return $q->where('id', $id);
        })
		->when($name,function($q) use($name){
            return $q->where('name', $name);
        })
		->when($title,function($q) use($title){
            return $q->where('title', $title);
        })
		->when($description,function($q) use($description){
            return $q->where('description', $description);
        })
		;
    }
}
