<?php

namespace App\Domain\Ticket\Repositories\Eloquent;

use App\Domain\Ticket\Repositories\Contracts\StatusRepository;
use App\Domain\Ticket\Entities\Status;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class StatusRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StatusRepositoryEloquent extends EloquentRepository implements StatusRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Status::class;
}