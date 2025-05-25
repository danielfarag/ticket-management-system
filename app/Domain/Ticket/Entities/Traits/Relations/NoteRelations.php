<?php
namespace App\Domain\Ticket\Entities\Traits\Relations;

use App\Domain\Ticket\Entities\Ticket;
use App\Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait NoteRelations
{
    /**
     * Get ticket assigned this note.
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Get agent assigned this note.
     */
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}