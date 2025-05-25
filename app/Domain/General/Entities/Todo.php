<?php

namespace App\Domain\General\Entities;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\General\Entities\Traits\Relations\TodoRelations;
use App\Domain\General\Entities\Traits\CustomAttributes\TodoAttributes;
use App\Domain\General\Repositories\Contracts\TodoRepository;

class Todo extends Model implements HasMedia
{
    use TodoRelations, TodoAttributes, HasFactory, InteractsWithMedia;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Todo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'body',
        'priority',
        'status',
        'agent_id',
        'due_at'
    ];

    
    /**
    * The attributes that should be cast.
    *
    * @var array
    */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'due_at'     => 'datetime:Y-m-d h:i:s'
    ];


    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "todos";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = TodoRepository::class;
}
