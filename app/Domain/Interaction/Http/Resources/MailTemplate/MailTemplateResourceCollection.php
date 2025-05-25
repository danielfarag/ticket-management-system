<?php

namespace App\Domain\Interaction\Http\Resources\MailTemplate;

use App\Infrastructure\Http\AbstractResources\BaseCollection as ResourceCollection;

class MailTemplateResourceCollection extends ResourceCollection
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
