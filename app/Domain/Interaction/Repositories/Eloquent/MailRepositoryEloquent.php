<?php

namespace App\Domain\Interaction\Repositories\Eloquent;

use App\Domain\Interaction\Repositories\Contracts\MailRepository;
use App\Domain\Interaction\Entities\Mail;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class MailRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MailRepositoryEloquent extends EloquentRepository implements MailRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Mail::class;
}