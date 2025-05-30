<?php

namespace App\Domain\Cms\Http\Resources\Article;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class ArticleResource extends JsonResource
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
            'title'         => $this->title,    
            'body'          => $this->body,    
            'author'        => optional($this->author)->email,    
            'category'      => optional($this->category)->name,    
            'status'        => $this->status,    
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
