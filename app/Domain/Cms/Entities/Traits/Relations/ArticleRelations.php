<?php

namespace App\Domain\Cms\Entities\Traits\Relations;

use App\Domain\General\Entities\Category;
use App\Domain\General\Entities\Comment;
use App\Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait ArticleRelations
{
    /**
     * Get all of the posts that are assigned this category.
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    /**
     * Return comments entity
     *
     * @return MorphMany
     */
    public function comments(): MorphMany{
        return $this->morphMany(Comment::class, 'commentable');
    }    


    /**
     * Return User entity
     *
     * @return MorphMany
     */
    public function author(): BelongsTo{
        return $this->belongsTo(User::class);
    }    

    /**
     * Get all the users created by the user.
     */
    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot(['up']);
    }

}
