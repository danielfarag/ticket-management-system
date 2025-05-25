<?php

namespace App\Domain\Ticket\Entities\Traits\Relations;

use App\Domain\Ticket\Entities\Ticket;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait StatusRelations
{
    /**
     * return Tickets relation
     *
     * @return HasMany
     */
    public function tickets(): HasMany{
        return $this->hasMany(Ticket::class);
    }

}
