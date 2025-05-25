<?php

namespace App\Domain\Interaction\Entities;

use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\Interaction\Entities\Traits\Relations\ContactRelations;
use App\Domain\Interaction\Entities\Traits\CustomAttributes\ContactAttributes;
use App\Domain\Interaction\Repositories\Contracts\ContactRepository;

class Contact extends Model
{
    use ContactRelations, ContactAttributes;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Contact';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'message'
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "contacts";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = ContactRepository::class;
}
