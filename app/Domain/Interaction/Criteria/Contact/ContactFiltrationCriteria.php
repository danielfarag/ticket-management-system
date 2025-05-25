<?php

namespace App\Domain\Interaction\Criteria\Contact;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class ContactFiltrationCriteria implements CriteriaInterface
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
		$email = request()->query('email',false);
		$phone_number = request()->query('phone_number',false);
        $created_at = request()->query('created_at',false);
		$updated_at = request()->query('updated_at',false);
		
        
        return $model
        ->when($id,function($q) use($id){
            return $q->where('id', $id);
        })
		->when($name,function($q) use($name){
            return $q->where('name', $name);
        })
		->when($email,function($q) use($email){
            return $q->where('email', $email);
        })
		->when($phone_number,function($q) use($phone_number){
            return $q->where('phone_number', 'LIKE', '%'.$phone_number.'%');
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
