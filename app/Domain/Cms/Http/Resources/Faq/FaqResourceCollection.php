<?php

namespace App\Domain\Cms\Http\Resources\Faq;

use App\Infrastructure\Http\AbstractResources\BaseCollection as ResourceCollection;

class FaqResourceCollection extends ResourceCollection
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
