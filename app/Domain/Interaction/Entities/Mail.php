<?php

namespace App\Domain\Interaction\Entities;

use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\Interaction\Entities\Traits\Relations\MailRelations;
use App\Domain\Interaction\Entities\Traits\CustomAttributes\MailAttributes;
use App\Domain\Interaction\Repositories\Contracts\MailRepository;

class Mail extends Model
{
    use MailRelations, MailAttributes;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Mail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'subject',
        'body',
        'status',
        'send_at'
    ];

    /**
    * The attributes that should be cast.
    *
    * @var array
    */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'deleted_at' => 'datetime:Y-m-d',
        'send_at'    => 'datetime:Y-m-d h:i:s'
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "mails";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = MailRepository::class;
}
