<?php

namespace App\Domain\General\Criteria\Todo;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class TodoSortedByCriteria implements CriteriaInterface
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
        $order = request()->query('order','desc');
        $order_by = request()->query('order_by','id');
        if($order == 'asc'){
            return $model->orderBy($order_by);
        }else{
            return $model->orderByDesc($order_by);
        }
    }
}
