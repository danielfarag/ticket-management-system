<?php

namespace App\Domain\Ticket\Entities\Traits\Scopes;

trait DepartmentScopes
{
    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('status', 'active');
    }
}
