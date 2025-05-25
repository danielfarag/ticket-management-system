<?php

namespace App\Domain\Ticket\Criteria\Ticket;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class TicketFiltrationCriteria implements CriteriaInterface
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
		$subject = request()->query('subject',false);
		$user_name = request()->query('user_name',false);
		$agent_name = request()->query('agent_name',false);
		$severity_name = request()->query('severity_name',false);
		$status_name = request()->query('status_name',false);
		$category_name = request()->query('category_name',false);
		$solved = request()->query('solved',false);
		$created_at = request()->query('created_at',false);
		$updated_at = request()->query('updated_at',false);
		
        
        return $model
        ->when($id,function($q) use($id){
            return $q->where('id', $id);
        })
		->when($subject,function($q) use($subject){
            return $q->where('subject', $subject);
        })
		->when($user_name,function($q) use($user_name){
            return $q->where('user_name', $user_name);
        })
		->when($agent_name,function($q) use($agent_name){
            $agents = explode(',',$agent_name);
          
            return $q->where(function($q)use($agents){
                foreach ($agents as $agent){
                    $q->orWhere('agent_name', "LIKE", '%'.$agent.'%');
                }
            });
        })
		->when($severity_name,function($q) use($severity_name){
            $severity_name = !is_array($severity_name) ? [$severity_name] : $severity_name;
          
            return $q->whereIn('severity_name', $severity_name);
        })
		->when($status_name,function($q) use($status_name){
            $status_name = !is_array($status_name) ? [$status_name] : $status_name;
          
            return $q->whereIn('status_name', $status_name);
        })
        ->when($category_name,function($q) use($category_name){
            $category_name = !is_array($category_name) ? [$category_name] : $category_name;
          
            return $q->whereIn('category_name', $category_name);
        })
        ->when($solved,function($q) use($solved){
            $solved = !is_array($solved) ? [$solved] : $solved;
          
            return $q->whereIn('solved', $solved);
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
        ->when(auth()->user()->type=='agent',function($q){
            return $q->where(function($q){
                $q->orWhere('agent_name', "LIKE", '%'.auth()->user()->name.'%');
            });
        })
		;
    }
}
