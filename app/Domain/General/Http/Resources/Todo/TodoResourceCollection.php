<?php

namespace App\Domain\General\Http\Resources\Todo;

use App\Infrastructure\Http\AbstractResources\BaseCollection as ResourceCollection;

class TodoResourceCollection extends ResourceCollection
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
