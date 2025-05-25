<?php

namespace App\Domain\Ticket\Http\Resources\Ticket;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class TicketResource extends JsonResource
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
            'subject'      => $this->subject,
            'body'         => $this->body,
            'user'         => optional($this->user)->email,
            'severity'     => optional($this->severity)->name,
            'status'       => optional($this->status)->name,
            'category'     => optional($this->category)->name,
            'solved'       => $this->solved,
            'agents'       => optional(optional($this->agents)->pluck('email'))->join(','),
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
