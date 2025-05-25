<?php

namespace App\Domain\Ticket\Http\Resources\Department;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class DepartmentResource extends JsonResource
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
            'description'   => $this->description,
            'status'        => $this->status,
            'categories'    => optional(optional($this->categories)->pluck('name'))->join(','),
            'agents'        => optional(optional($this->agents)->pluck('email'))->join(','),
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
