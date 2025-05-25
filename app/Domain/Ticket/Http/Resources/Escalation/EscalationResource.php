<?php

namespace App\Domain\Ticket\Http\Resources\Escalation;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class EscalationResource extends JsonResource
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
            'creator'     => optional($this->agent)->email,
            'ticket'      => optional($this->ticket)->subject,
            'body'        => $this->body,
            'status'      => $this->status,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
