<?php

namespace App\Domain\Setting\Repositories\Eloquent;

use App\Domain\Setting\Repositories\Contracts\BlockIpRepository;
use App\Domain\Setting\Entities\BlockIp;
use App\Domain\Setting\Entities\Views\BlockIpView;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class BlockIpRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BlockIpRepositoryEloquent extends EloquentRepository implements BlockIpRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = BlockIp::class;

    /**
     * View Name
     * @var String
     */
    protected $view_class = BlockIpView::class;

}