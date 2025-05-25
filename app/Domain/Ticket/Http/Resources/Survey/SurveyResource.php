<?php

namespace App\Domain\Ticket\Http\Resources\Survey;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class SurveyResource extends JsonResource
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
            'ticket'       => optional($this->ticket)->subject,
            'resolved'     => $this->resolved,
            'comment'      => $this->comment,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
