<?php

namespace App\Domain\General\Criteria\Todo;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class TodoFiltrationCriteria implements CriteriaInterface
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
		$agent_name = auth()->user()->type == 'admin' ? request()->query('agent_name',false) : auth()->user()->name;
		$body = request()->query('body',false);
		$status = request()->query('status',false);
		$priority = request()->query('priority',false);
		$due_at = request()->query('due_at',false);
		$created_at = request()->query('created_at',false);
		$updated_at = request()->query('updated_at',false);
		
        
        return $model
        ->when($id,function($q) use($id){
            return $q->where('id', $id);
        })
		->when($subject,function($q) use($subject){
            return $q->where('subject', $subject);
        })
		->when($agent_name,function($q) use($agent_name){
            return $q->where('agent_name', $agent_name);
        })
        ->when($body,function($q) use($body){
            return $q->where('body', $body);
        })
        ->when($status,function($q) use($status){
            $statuses = !is_array($status) ? [$status] : $status;
          
            return $q->whereIn('status', $statuses);
        })
		->when($priority,function($q) use($priority){
            $priorities = !is_array($priority) ? [$priority] : $priority;
          
            return $q->whereIn('priority', $priorities);
        })
        ->when($due_at,function($q) use($due_at){
            if(is_array($due_at)){
                return $q->whereBetween('due_at', $due_at);
            }else{
                return $q->whereDate('due_at', $due_at);
            }
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
