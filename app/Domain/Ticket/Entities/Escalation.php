<?php

namespace App\Domain\Ticket\Entities;

use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\Ticket\Entities\Traits\Relations\EscalationRelations;
use App\Domain\Ticket\Entities\Traits\CustomAttributes\EscalationAttributes;
use App\Domain\Ticket\Repositories\Contracts\EscalationRepository;

class Escalation extends Model
{
    use EscalationRelations, EscalationAttributes;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Escalation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creator_id',
        'ticket_id',
        'body',
        'status'
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "escalations";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = EscalationRepository::class;
}
