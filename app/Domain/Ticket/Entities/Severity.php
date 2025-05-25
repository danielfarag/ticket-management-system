<?php

namespace App\Domain\Ticket\Entities;

use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\Ticket\Entities\Traits\Relations\SeverityRelations;
use App\Domain\Ticket\Entities\Traits\CustomAttributes\SeverityAttributes;
use App\Domain\Ticket\Repositories\Contracts\SeverityRepository;

class Severity extends Model
{
    use SeverityRelations, SeverityAttributes;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Severity';

    /**
     * @var array
     */
    public static $colors = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'priority',
        'color',
        'status'
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "severities";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = SeverityRepository::class;

    /**
     * Return Color
     * Helps to minimize the n+1 effect
     *
     * @return string
     */
    public static function getColor($value){

        if(!array_key_exists($value, self::$colors)){
            $color = self::where('name',$value)->first();
            self::$colors[$value] = $color->color;
        }
        
        return self::$colors[$value];
    }
}