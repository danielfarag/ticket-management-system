<?php

namespace App\Domain\General\Entities\Traits\Relations;

use App\Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait TodoRelations
{
    /**
     * return user_id relation
     *
     * @return BelongsTo
     */
    public function agent(): BelongsTo{
        return $this->belongsTo(User::class, 'agent_id');
    }
}
