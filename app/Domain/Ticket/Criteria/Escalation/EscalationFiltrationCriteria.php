<?php

namespace App\Domain\Ticket\Criteria\Escalation;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class EscalationFiltrationCriteria implements CriteriaInterface
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
		$creator_name = request()->query('creator_name',false);
		$ticket_subject = request()->query('ticket_subject',false);
        $status = request()->query('status',false);  
        $created_at = request()->query('created_at',false);
		$updated_at = request()->query('updated_at',false);
		
        
        return $model
        ->when($id,function($q) use($id){
            return $q->where('id', $id);
        })
		->when($creator_name,function($q) use($creator_name){
            return $q->where('creator_name', 'LIKE', '%'.$creator_name.'%');
        })
		->when($ticket_subject,function($q) use($ticket_subject){
            return $q->where('ticket_subject', 'LIKE','%' . $ticket_subject . '%');
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
		->when(auth()->user()->type == 'agent',function($q){
            return $q->whereHas('ticket.agents', function($q){
                $q->where('users.id', auth()->id());
            });
        })
		;
    }
}
