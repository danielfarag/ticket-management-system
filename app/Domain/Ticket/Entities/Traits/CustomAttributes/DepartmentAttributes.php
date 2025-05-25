<?php

namespace App\Domain\Ticket\Entities\Traits\CustomAttributes;

trait DepartmentAttributes
{
    /**
     * Get Department Image
     *
     * @return string
     */
    public function getImageAttribute(){
        return $this->getFirstMediaUrl('image');
    }

}
