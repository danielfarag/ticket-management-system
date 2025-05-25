<?php

namespace App\Domain\User\Entities\Traits\Relations;

use App\Domain\Cms\Entities\Article;
use App\Domain\General\Entities\Todo;
use App\Domain\Ticket\Entities\Department;
use App\Domain\Ticket\Entities\Ticket;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait UserRelations
{
    /**
     * Get all of the Departments that are assigned this Agent.
     */
    public function departments() : BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'agent_department');
    }

    /**
     * Get all the tickets created by the user.
     */
    public function tickets() : HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Get all the articles created by the user.
     */
    public function articles() : BelongsToMany
    {
        return $this->BelongsToMany(Article::class)->withPivot(['up']);
    }

    /**
     * Get all the tickets created by the user.
     */
    public function assignees() : BelongsToMany
    {
        return $this->BelongsToMany(Ticket::class, 'agent_ticket', 'agent_id', 'ticket_id');
    }

    /**
     * Get all the todos created by the user.
     */
    public function todos() : HasMany
    {
        return $this->hasMany(Todo::class, 'agent_id');
    }
}
