<?php

namespace App\Domain\Setting\Entities\Traits\Relations;

use App\Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BlockIpRelations
{
    
    /**
     * Return blocker
     *
     * @return BelongsTo
     */
    public function blocker() : BelongsTo{
        return $this->belongsTo(User::class);
    }
}