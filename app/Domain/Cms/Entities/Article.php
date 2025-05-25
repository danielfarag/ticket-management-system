<?php

namespace App\Domain\Cms\Entities;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\Cms\Repositories\Contracts\ArticleRepository;
use App\Domain\Cms\Entities\Traits\Relations\ArticleRelations;
use App\Domain\Cms\Entities\Traits\CustomAttributes\ArticleAttributes;

class Article extends Model implements Viewable, HasMedia
{
    use ArticleRelations, ArticleAttributes, InteractsWithViews, InteractsWithMedia;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Article';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'author_id',
        'status',
    ];

    /**
     * Append attribute to Ticket Object.
     *
     * @var array
     */
    protected $appends  = [
        "category",
        "image",
        "seen",
        "useful",
    ];
    
    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "articles";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = ArticleRepository::class;
}
