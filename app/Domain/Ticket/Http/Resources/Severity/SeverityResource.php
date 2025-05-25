<?php

namespace App\Domain\Ticket\Http\Resources\Severity;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class SeverityResource extends JsonResource
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
            'priority'     => $this->priority,
            'name'         => $this->name,
            'color'        => $this->color,
            'status'       => $this->status,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
