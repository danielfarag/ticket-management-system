<?php

namespace App\Domain\Interaction\Criteria\Mail;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class MailFiltrationCriteria implements CriteriaInterface
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
		$email = request()->query('email',false);
		$subject = request()->query('subject',false);
		$status = request()->query('status',false);
        $send_at = request()->query('send_at',false);
		$created_at = request()->query('created_at',false);
		$updated_at = request()->query('updated_at',false);
		
        
        return $model
        ->when($id,function($q) use($id){
            return $q->where('id', $id);
        })
		->when($email,function($q) use($email){
            return $q->where('email', 'LIKE', '%'. $email . '%');
        })
		->when($subject,function($q) use($subject){
            return $q->where('subject', 'LIKE', '%'.$subject.'%');
        })
        ->when($status,function($q) use($status){
            $statuses = !is_array($status) ? [$status] : $status;
          
            return $q->whereIn('status', $statuses);
        })
        ->when($send_at,function($q) use($send_at){
            if(is_array($send_at)){
                return $q->whereBetween('send_at', $send_at);
            }else{
                return $q->whereDate('send_at', $send_at);
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
