<?php

namespace App\Domain\General\Entities\Traits\Relations;

use App\Domain\Cms\Entities\Article;
use App\Domain\Cms\Entities\Faq;
use App\Domain\Ticket\Entities\Department;
use App\Domain\Ticket\Entities\Ticket;

trait CategoryRelations
{
    /**
     * Get all of the departments that are assigned this category.
     */
    public function departments()
    {
        return $this->morphedByMany(Department::class, 'categorizable');
    }

    /**
     * Get all of the articles that are assigned this category.
     */
    public function articles()
    {
        return $this->morphedByMany(Article::class, 'categorizable');
    }

    /**
     * Get all of the tickets that are assigned this category.
     */
    public function tickets()
    {
        return $this->morphedByMany(Ticket::class, 'categorizable');
    }

    /**
     * Get all of the faqs that are assigned this category.
     */
    public function faqs()
    {
        return $this->morphedByMany(Faq::class, 'categorizable');
    }
}
