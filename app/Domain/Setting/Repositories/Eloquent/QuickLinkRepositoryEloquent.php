<?php

namespace App\Domain\Setting\Repositories\Eloquent;

use App\Domain\Setting\Repositories\Contracts\QuickLinkRepository;
use App\Domain\Setting\Entities\QuickLink;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class QuickLinkRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class QuickLinkRepositoryEloquent extends EloquentRepository implements QuickLinkRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = QuickLink::class;
}