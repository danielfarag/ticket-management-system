<?php

namespace App\Domain\User\Entities\Traits\CustomAttributes;

trait UserAttributes
{
    /**
     * Get Image
     *
     * @return string
     */
    public function getRoleAttribute(){
        return $this->roles()->first();
    }
}
