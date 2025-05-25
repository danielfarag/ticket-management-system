<?php

namespace App\Domain\General\Repositories\Eloquent;

use App\Domain\General\Repositories\Contracts\ServiceRepository;
use App\Domain\General\Entities\Service;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class ServiceRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ServiceRepositoryEloquent extends EloquentRepository implements ServiceRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Service::class;
}