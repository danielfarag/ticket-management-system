<?php

namespace App\Domain\Cms\Entities\Traits\CustomAttributes;

trait ArticleAttributes
{
    /**
     * Get Image
     *
     * @return string
     */
    public function getImageAttribute(){
        return $this->getFirstMediaUrl('image');
    }

    /**
     * Get Category Pbkect
     *
     * @return Category
     */
    public function getCategoryAttribute(){
        return $this->categories->first();
    }

    /**
     * Get Category Pbkect
     *
     * @return Category
     */
    public function getSeenAttribute(){
        return views($this)->count();
    }

    /**
     * Get Category Pbkect
     *
     * @return Category
     */
    public function getUsefulAttribute(){
        if(auth()->check()){
            return optional(optional($this->users()->where('user_id', auth()->id())->first())->pivot)->up;
        }
        return null;
    }
}
