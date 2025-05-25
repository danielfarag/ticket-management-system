<?php

namespace App\Domain\Ticket\Entities\Traits\Relations;

use App\Domain\Cms\Entities\Faq;
use App\Domain\General\Entities\Category;
use App\Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait DepartmentRelations
{
    /**
     * Get all of the categories that are assigned this department.
     */
    public function categories() : MorphToMany
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    /**
     * Get all of the Faqs that are assigned this department.
     */
    public function faqs() : HasMany
    {
        return $this->hasMany(Faq::class);
    }

    /**
     * Get all of the agents that are assigned this department.
     */
    public function agents() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'agent_department', 'department_id', 'agent_id');
    }
}
