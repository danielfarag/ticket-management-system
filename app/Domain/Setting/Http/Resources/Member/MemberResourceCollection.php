<?php

namespace App\Domain\Setting\Http\Resources\Member;

use App\Infrastructure\Http\AbstractResources\BaseCollection as ResourceCollection;

class MemberResourceCollection extends ResourceCollection
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
