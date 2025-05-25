<?php

namespace App\Domain\User\Http\Resources\Role;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class RoleResource extends JsonResource
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
            'permissions'  => optional(optional($this->permissions)->pluck('name'))->join(','),
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
