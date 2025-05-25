<?php

namespace App\Domain\Setting\Entities;

use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\Setting\Entities\Traits\Relations\QuickLinkRelations;
use App\Domain\Setting\Entities\Traits\CustomAttributes\QuickLinkAttributes;
use App\Domain\Setting\Repositories\Contracts\QuickLinkRepository;

class QuickLink extends Model
{
    use QuickLinkRelations, QuickLinkAttributes;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'QuickLink';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'url',
        'priority'
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "quick_links";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = QuickLinkRepository::class;
}
