<?php

namespace App\Domain\Ticket\Entities;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\Ticket\Entities\Traits\Scopes\DepartmentScopes;
use App\Domain\Ticket\Repositories\Contracts\DepartmentRepository;
use App\Domain\Ticket\Entities\Traits\Relations\DepartmentRelations;
use App\Domain\Ticket\Entities\Traits\CustomAttributes\DepartmentAttributes;

class Department extends Model implements HasMedia
{
    use DepartmentRelations, DepartmentAttributes, DepartmentScopes, InteractsWithMedia;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Department';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    /**
     * Appends Custom Attributes To Department Object.
     *
     * @var array
     */
    protected $appends = ["image"];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "departments";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = DepartmentRepository::class;
}
