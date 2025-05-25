<?php

namespace App\Domain\Interaction\Http\Resources\Announcement;

use App\Infrastructure\Http\AbstractResources\BaseCollection as ResourceCollection;

class AnnouncementResourceCollection extends ResourceCollection
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
