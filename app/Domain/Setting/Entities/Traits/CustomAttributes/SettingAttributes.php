<?php

namespace App\Domain\Setting\Entities\Traits\CustomAttributes;

trait SettingAttributes
{
    /**
     * Get Setting Logo
     *
     * @return string
     */
    public function getLogoAttribute(){
        return $this->getFirstMediaUrl('logo');
    }
}
