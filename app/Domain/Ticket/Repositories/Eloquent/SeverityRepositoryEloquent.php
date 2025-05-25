<?php

namespace App\Domain\Ticket\Repositories\Eloquent;

use App\Domain\Ticket\Repositories\Contracts\SeverityRepository;
use App\Domain\Ticket\Entities\Severity;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class SeverityRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SeverityRepositoryEloquent extends EloquentRepository implements SeverityRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Severity::class;
}