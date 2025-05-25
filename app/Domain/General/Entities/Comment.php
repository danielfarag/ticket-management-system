<?php

namespace App\Domain\General\Entities;

use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\General\Entities\Traits\Relations\CommentRelations;
use App\Domain\General\Entities\Traits\CustomAttributes\CommentAttributes;
use App\Domain\General\Repositories\Contracts\CommentRepository;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Comment extends Model implements HasMedia
{
    use CommentRelations, CommentAttributes, InteractsWithMedia;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Comment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'commentable_id',
        'commentable_type',
        'comment',
    ];

    /**
     * Append attribute to Ticket Object.
     *
     * @var array
     */
    protected $appends  = [
        "attachments"
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "comments";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = CommentRepository::class;
}
