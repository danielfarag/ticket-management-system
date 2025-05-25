<?php

namespace App\Domain\Ticket\Repositories\Eloquent;

use App\Domain\Ticket\Entities\Department;
use App\Domain\Ticket\Entities\Views\DepartmentView;
use App\Infrastructure\AbstractRepositories\EloquentRepository;
use App\Domain\Ticket\Repositories\Contracts\DepartmentRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DepartmentRepositoryEloquent extends EloquentRepository implements DepartmentRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Department::class;

    /**
     * View Name
     * @var String
     */
    protected $view_class = DepartmentView::class;
}