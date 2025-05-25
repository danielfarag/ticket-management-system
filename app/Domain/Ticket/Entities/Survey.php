<?php

namespace App\Domain\Ticket\Entities;

use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\Ticket\Entities\Traits\Relations\SurveyRelations;
use App\Domain\Ticket\Entities\Traits\CustomAttributes\SurveyAttributes;
use App\Domain\Ticket\Repositories\Contracts\SurveyRepository;

class Survey extends Model
{
    use SurveyRelations, SurveyAttributes;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Survey';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_id',
        'resolved',
        'comment',
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "surveys";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = SurveyRepository::class;
}
