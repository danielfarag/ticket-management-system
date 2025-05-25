<?php

namespace App\Domain\User\Http\Resources\User;

use App\Infrastructure\Http\AbstractResources\BaseCollection as ResourceCollection;

class UserResourceCollection extends ResourceCollection
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
