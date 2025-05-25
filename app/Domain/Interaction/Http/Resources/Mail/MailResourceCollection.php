<?php

namespace App\Domain\Interaction\Http\Resources\Mail;

use App\Infrastructure\Http\AbstractResources\BaseCollection as ResourceCollection;

class MailResourceCollection extends ResourceCollection
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
