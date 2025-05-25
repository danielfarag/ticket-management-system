<?php

namespace App\Domain\General\Http\Resources\Slider;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class SliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'subtitle'      => $this->subtitle,
            'title'         => $this->title,
            'button'        => $this->button,
            'link'          => $this->link,
            'status'        => $this->status,
            'image'         => $this->image,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
