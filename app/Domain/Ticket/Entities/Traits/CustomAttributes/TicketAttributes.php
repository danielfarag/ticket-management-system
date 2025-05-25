<?php

namespace App\Domain\Ticket\Entities\Traits\CustomAttributes;

use App\Domain\General\Entities\Category;

trait TicketAttributes
{
    /**
     * Get Category Pbkect
     *
     * @return Category
     */
    public function getCategoryAttribute(){
        return $this->categories->first();
    }

    /**
     * Check if the current Ticket has been escalated
     *
     * @return bool
     */
    public function getIsEscalatedAttribute(){
        return $this->escalation !== null;
    }

    /**
     * Get Attachments
     *
     * @return array
     */
    public function getAttachmentsAttribute(){
        return $this->getMedia('attachments')->map(function($media){
            return $media->getFullUrl();
        });
    }
}
