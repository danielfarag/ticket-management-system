<?php

namespace App\Domain\General\Http\Resources\Todo;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class TodoResource extends JsonResource
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
            'id'             =>  $this->id,
            'agent'          =>  optional($this->agent)->email,
            'subject'        =>  $this->subject,
            'body'           =>  $this->body,
            'priority'       =>  $this->priority,
            'status'         =>  $this->status,
            'due_at'         =>  $this->due_at,
            'created_at'     =>  $this->created_at,
            'updated_at'     =>  $this->updated_at,
        ];
    }
}
