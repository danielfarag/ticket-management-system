<?php

namespace App\Domain\Ticket\Entities\Traits\Relations;

use App\Domain\User\Entities\User;
use App\Domain\Ticket\Entities\Ticket;
use App\Domain\General\Entities\Comment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait EscalationRelations
{
    /**
     * return agent relation
     *
     * @return BelongsTo
     */
    public function agent(): BelongsTo{
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * return ticket relation
     *
     * @return BelongsTo
     */
    public function ticket(): BelongsTo{
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Get all of the comments related this escalation.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}
