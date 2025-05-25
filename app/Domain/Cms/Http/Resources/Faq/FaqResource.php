<?php

namespace App\Domain\Cms\Http\Resources\Faq;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class FaqResource extends JsonResource
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
            'question'    => $this->question,    
            'answer'      => $this->answer,    
            'article'     => optional($this->article)->title,    
            'department'  => optional($this->department)->name,    
            'status'      => $this->status,    
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
