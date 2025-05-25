<?php

namespace App\Domain\Setting\Http\Resources\Setting;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class SettingResource extends JsonResource
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
            'key'           => $this->key,
            'value'         => $this->value,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
