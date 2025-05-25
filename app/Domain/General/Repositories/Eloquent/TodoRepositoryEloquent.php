<?php

namespace App\Domain\General\Repositories\Eloquent;

use App\Domain\General\Repositories\Contracts\TodoRepository;
use App\Domain\General\Entities\Todo;
use App\Domain\General\Entities\Views\TodoView;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class TodoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TodoRepositoryEloquent extends EloquentRepository implements TodoRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Todo::class;

    /**
     * View Model Name
     * @var String
     */
    protected $view_class = TodoView::class;
}