<?php

namespace App\Domain\User\Criteria\User;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class UserFiltrationCriteria implements CriteriaInterface
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
		$type = auth()->user()->type == 'admin' ? request()->query('type',false) : 'user';
		$status = request()->query('status',false);
        $roles = request()->query('roles',false);  
		$created_at = request()->query('created_at',false);
		$updated_at = request()->query('updated_at',false);
		
        
        return $model
        ->when($id,function($q) use($id){
            return $q->where('id', $id);
        })
		->when($name,function($q) use($name){
            return $q->where('name','LIKE','%'. $name .'%');
        })
		->when($email,function($q) use($email){
            return $q->where('email', $email);
        })
		->when($phone_number,function($q) use($phone_number){
            return $q->where('phone_number', $phone_number);
        })
		->when($type,function($q) use($type){
            $types = !is_array($type) ? [$type] : $type;
          
            return $q->whereIn('type', $types);
        })
		->when($status,function($q) use($status){
            $statuses = !is_array($status) ? [$status] : $status;
          
            return $q->whereIn('status', $statuses);
        })
        ->when($roles,function($q) use($roles){
            $roles = !is_array($roles) ? [$roles] : $roles;
            return $q->where(function($q) use($roles){
                foreach ($roles as $role) {
                    $q->orWhere('roles', 'LIKE', '%'.$role.'%');
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
