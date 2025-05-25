<?php

namespace App\Domain\Ticket\Http\Resources\Department;

use App\Infrastructure\Http\AbstractResources\BaseCollection as ResourceCollection;

class DepartmentResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

}
