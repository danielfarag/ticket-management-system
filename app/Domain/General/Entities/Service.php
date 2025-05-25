<?php

namespace App\Domain\General\Entities;

use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\General\Entities\Traits\Relations\ServiceRelations;
use App\Domain\General\Entities\Traits\CustomAttributes\ServiceAttributes;
use App\Domain\General\Repositories\Contracts\ServiceRepository;

class Service extends Model
{
    use ServiceRelations, ServiceAttributes;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Service';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'icon',
        'title',
        'description',
        'status'
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "services";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = ServiceRepository::class;
}
