<?php

namespace App\Domain\Cms\Entities\Traits\Relations;

use App\Domain\Cms\Entities\Article;
use App\Domain\Ticket\Entities\Department;

trait FaqRelations
{
    /**
     * Get Department assigned to faq.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get Article assigned to faq.
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
