<?php

namespace App\Domain\Interaction\Entities;

use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\Interaction\Entities\Traits\Relations\AnnouncementRelations;
use App\Domain\Interaction\Entities\Traits\CustomAttributes\AnnouncementAttributes;
use App\Domain\Interaction\Repositories\Contracts\AnnouncementRepository;

class Announcement extends Model
{
    use AnnouncementRelations, AnnouncementAttributes;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Announcement';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'in',
        'content',
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "announcements";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = AnnouncementRepository::class;
}
