<?php

namespace App\Domain\Setting\Http\Resources\Member;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class MemberResource extends JsonResource
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
            'name'          => $this->name,
            'title'         => $this->title,
            'description'   => $this->description,
            'image'         => $this->image,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
