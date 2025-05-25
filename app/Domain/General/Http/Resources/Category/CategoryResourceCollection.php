<?php

namespace App\Domain\General\Http\Resources\Category;

use App\Infrastructure\Http\AbstractResources\BaseCollection as ResourceCollection;

class CategoryResourceCollection extends ResourceCollection
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
