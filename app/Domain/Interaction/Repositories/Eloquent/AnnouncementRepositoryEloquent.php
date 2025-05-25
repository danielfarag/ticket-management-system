<?php

namespace App\Domain\Interaction\Repositories\Eloquent;

use App\Domain\Interaction\Repositories\Contracts\AnnouncementRepository;
use App\Domain\Interaction\Entities\Announcement;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class AnnouncementRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AnnouncementRepositoryEloquent extends EloquentRepository implements AnnouncementRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Announcement::class;
}