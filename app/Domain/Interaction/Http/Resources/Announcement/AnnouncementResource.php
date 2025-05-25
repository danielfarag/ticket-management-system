<?php

namespace App\Domain\Interaction\Http\Resources\Announcement;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class AnnouncementResource extends JsonResource
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
            'id'          => $this->id,
            'in'          => $this->in,    
            'content'     => $this->content,    
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
