<?php

namespace App\Domain\General\Entities;

use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\General\Entities\Traits\Relations\CategoryRelations;
use App\Domain\General\Entities\Traits\CustomAttributes\CategoryAttributes;
use App\Domain\General\Repositories\Contracts\CategoryRepository;
use Plank\Metable\Metable;

class Category extends Model
{
    use CategoryRelations, CategoryAttributes, Metable;
    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
        'type',
    ];

    /**
     * Appends data to model object.
     *
     * @var array
     */
    protected $appends = [
        'icon',
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "categories";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = CategoryRepository::class;
}
