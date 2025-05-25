<?php

namespace App\Domain\Interaction\Http\Resources\Mail;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class MailResource extends JsonResource
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
            'email'       => $this->email,    
            'subject'     => $this->subject,    
            'body'        => $this->body,    
            'status'      => $this->status,
            'send_at'     => $this->send_at,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
