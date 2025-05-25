<?php

namespace App\Domain\General\Http\Resources\Slider;

use App\Infrastructure\Http\AbstractResources\BaseCollection as ResourceCollection;

class SliderResourceCollection extends ResourceCollection
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
