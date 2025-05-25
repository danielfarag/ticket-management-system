<?php

namespace App\Domain\Interaction\Http\Resources\MailTemplate;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class MailTemplateResource extends JsonResource
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
            'type'          => $this->type,
            'subject'       => $this->subject,
            'body'          => $this->body,
            'default'       => $this->default,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
