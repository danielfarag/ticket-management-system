<?php

namespace App\Domain\User\Http\Resources\User;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class UserResource extends JsonResource
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
            'id'                    =>  $this->id,
            'name'                  =>  $this->name,
            'email'                 =>  $this->email,
            'phone_number'          =>  $this->phone_number,
            'type'                  =>  $this->type,
            'status'                =>  $this->status,
            'role'                  =>  optional($this->role)->name,
            'created_at'            =>  $this->created_at,
            'updated_at'            =>  $this->updated_at,
        ];
    }
}
