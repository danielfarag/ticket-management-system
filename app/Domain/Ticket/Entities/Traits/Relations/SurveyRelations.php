<?php

namespace App\Domain\Ticket\Entities\Traits\Relations;

use App\Domain\Ticket\Entities\Ticket;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait SurveyRelations
{
    /**
     * Get ticket assigned this survey.
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}
