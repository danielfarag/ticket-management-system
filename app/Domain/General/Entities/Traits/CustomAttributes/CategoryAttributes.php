<?php

namespace App\Domain\General\Entities\Traits\CustomAttributes;

trait CategoryAttributes
{
    /**
     * Get Category Icon
     *
     * @return void
     */
    public function getIconAttribute(){
        return $this->getMeta('icon');
    }
}
