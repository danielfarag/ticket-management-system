<?php

namespace App\Domain\Ticket\Entities;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\Ticket\Repositories\Contracts\TicketRepository;
use App\Domain\Ticket\Entities\Traits\Relations\TicketRelations;
use App\Domain\Ticket\Entities\Traits\CustomAttributes\TicketAttributes;

class Ticket extends Model implements HasMedia
{
    use TicketRelations, TicketAttributes, InteractsWithMedia;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Ticket';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'body',
        'user_id',
        'severity_id',
        'status_id',
        'solved',
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "tickets";

    /**
     * Append attribute to Ticket Object.
     *
     * @var array
     */
    protected $appends  = [
        "category",
        "isEscalated",
        "attachments"
    ];

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = TicketRepository::class;
}
