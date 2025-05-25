<?php

namespace App\Domain\Ticket\Entities\Traits\Relations;

use App\Domain\User\Entities\User;
use App\Domain\Ticket\Entities\Note;
use App\Domain\Ticket\Entities\Status;
use App\Domain\Ticket\Entities\Survey;
use App\Domain\General\Entities\Comment;
use App\Domain\Ticket\Entities\Severity;
use App\Domain\General\Entities\Category;
use App\Domain\Ticket\Entities\Escalation;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait TicketRelations
{
    
    /**
     * return user_id relation
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    /**
     * return severity_id relation
     *
     * @return BelongsTo
     */
    public function severity(): BelongsTo{
        return $this->belongsTo(Severity::class);
    }

    /**
     * Get all of the categories that are assigned this ticket.
     */
    public function categories(): MorphToMany {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    /**
     * Get all of the comments related this ticket.
     */
    public function comments(): MorphMany {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get all of the notes that are assigned this ticket.
     */
    public function notes(): HasMany{
        return $this->hasMany(Note::class);
    }

    /**
     * return status_id relation
     *
     * @return BelongsTo
     */
    public function status(): BelongsTo{
        return $this->belongsTo(Status::class);
    }

    /**
     * return Escalation relation
     *
     * @return HasOne
     */
    public function escalation(): HasOne{
        return $this->hasOne(Escalation::class);
    }
       
    /**
     * return survey relation
     *
     * @return HasOne
     */
    public function survey(): HasOne{
        return $this->hasOne(Survey::class);
    }

    /**
     * return agent relation
     *
     * @return BelongsToMany
     */
    public function agents(): BelongsToMany{
        return $this->belongsToMany(User::class, 'agent_ticket', 'ticket_id', 'agent_id');
    }
}