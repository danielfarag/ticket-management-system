<?php

namespace App\Domain\Setting\Http\Resources\BlockIp;

use App\Infrastructure\Http\AbstractResources\BaseResource as JsonResource;

class BlockIpResource extends JsonResource
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
            'blocker'      => optional($this->blocker)->email,
            'ip_address'   => $this->ip_address,
            'reason'       => $this->reason,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
