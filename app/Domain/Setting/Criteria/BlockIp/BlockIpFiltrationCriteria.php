<?php

namespace App\Domain\Setting\Criteria\BlockIp;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class BlockIpFiltrationCriteria implements CriteriaInterface
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
		$blocker_name = request()->query('blocker_name',false);
		$ip_address = request()->query('ip_address',false);
		$reason = request()->query('reason',false);
        $created_at = request()->query('created_at',false);
		$updated_at = request()->query('updated_at',false);
		
        
        return $model
        ->when($id,function($q) use($id){
            return $q->where('id', $id);
        })
		->when($blocker_name,function($q) use($blocker_name){
            return $q->where('blocker_name', $blocker_name);
        })
		->when($ip_address,function($q) use($ip_address){
            return $q->where('ip_address', $ip_address);
        })
		->when($reason,function($q) use($reason){
            return $q->where('reason', 'LIKE', '%'.$reason.'%');
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
