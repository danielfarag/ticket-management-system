<?php

namespace App\Domain\General\Entities\Traits\Relations;

use App\Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

trait CommentRelations
{
    /**
     * Return commentable entity
     *
     * @return MorphTo
     */
    public function commentable(): MorphTo{
        return $this->morphTo();
    }  

    /**
     * Return comment creator
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }    
}
