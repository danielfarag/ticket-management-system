<?php

namespace App\Domain\General\Entities\Traits\CustomAttributes;

trait SliderAttributes
{
    /**
     * Get SLider Image
     *
     * @return string
     */
    public function getImageAttribute(){
        return $this->getFirstMediaUrl('image');
    }
}
