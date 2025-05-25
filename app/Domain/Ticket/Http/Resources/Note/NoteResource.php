<?php

namespace App\Domain\Ticket\Http\Resources\Note;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class NoteResource extends JsonResource
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
            'id'           => $this->id,
            'name'         => $this->name,
            'created_at'   => $this->created_at->format('Y-m-d h:ia'),
            'updated_at'   => $this->updated_at->format('Y-m-d h:ia'),
        ];
    }
}
