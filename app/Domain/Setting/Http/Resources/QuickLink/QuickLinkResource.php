<?php

namespace App\Domain\Setting\Http\Resources\QuickLink;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class QuickLinkResource extends JsonResource
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
            'id'                => $this->id,
            'title'             => $this->title,
            'url'               => $this->url,
            'priority'          => $this->priority,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}
