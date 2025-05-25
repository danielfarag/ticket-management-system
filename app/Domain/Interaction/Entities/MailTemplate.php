<?php

namespace App\Domain\Interaction\Entities;

use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\Interaction\Entities\Traits\Relations\MailTemplateRelations;
use App\Domain\Interaction\Entities\Traits\CustomAttributes\MailTemplateAttributes;
use App\Domain\Interaction\Repositories\Contracts\MailTemplateRepository;

class MailTemplate extends Model
{
    use MailTemplateRelations, MailTemplateAttributes;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'MailTemplate';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'subject',
        'body',
        'default'
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "mail_templates";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = MailTemplateRepository::class;
}
