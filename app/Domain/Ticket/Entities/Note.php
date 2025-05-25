<?php

namespace App\Domain\Ticket\Entities;

use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\Ticket\Entities\Traits\Relations\NoteRelations;
use App\Domain\Ticket\Entities\Traits\CustomAttributes\NoteAttributes;
use App\Domain\Ticket\Repositories\Contracts\NoteRepository;

class Note extends Model
{
    use NoteRelations, NoteAttributes;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Note';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'note',
        'ticket_id',
        'agent_id',
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "notes";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = NoteRepository::class;
}
