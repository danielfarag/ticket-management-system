<?php

namespace App\Domain\Setting\Entities\Traits\CustomAttributes;

trait MemberAttributes
{
    /**
     * Get SLider Image
     *
     * @return string
     */
    public function getImageAttribute(){
        $image = $this->getFirstMediaUrl('image');
        return $image == '' ? 'https://via.placeholder.com/80'  : $image;
    }
}
