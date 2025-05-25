<?php

namespace App\Domain\User\Http\Resources\Role;

use App\Infrastructure\Http\AbstractResources\BaseCollection as ResourceCollection;

class RoleResourceCollection extends ResourceCollection
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
