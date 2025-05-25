<?php

namespace App\Domain\Interaction\Repositories\Eloquent;

use App\Domain\Interaction\Repositories\Contracts\MailTemplateRepository;
use App\Domain\Interaction\Entities\MailTemplate;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class MailTemplateRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MailTemplateRepositoryEloquent extends EloquentRepository implements MailTemplateRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = MailTemplate::class;

    /**
     * Define Mail Templates
     * @var array
     */
    public static $templates = [
        'new_user'=>[
            'name',
            'email',
            'created_at',
        ],
        'ticket_created'=>[
            'user_name',
            'user_email',
            'url',
            'subject',
            'created_at',
        ]
    ];
}