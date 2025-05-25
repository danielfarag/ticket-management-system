<?php

namespace App\Domain\General\Entities\Traits\CustomAttributes;

trait CommentAttributes
{
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
