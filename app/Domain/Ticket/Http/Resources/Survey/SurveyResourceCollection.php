<?php

namespace App\Domain\Ticket\Http\Resources\Survey;

use App\Infrastructure\Http\AbstractResources\BaseCollection as ResourceCollection;

class SurveyResourceCollection extends ResourceCollection
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
