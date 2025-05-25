<?php

namespace App\Domain\General\Http\Resources\Comment;

use App\Infrastructure\Http\AbstractResources\BaseCollection as ResourceCollection;

class CommentResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

}
