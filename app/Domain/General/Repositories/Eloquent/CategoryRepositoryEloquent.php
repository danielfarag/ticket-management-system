<?php

namespace App\Domain\General\Repositories\Eloquent;

use App\Domain\Cms\Entities\Article;
use App\Domain\General\Repositories\Contracts\CategoryRepository;
use App\Domain\General\Entities\Category;
use App\Domain\Ticket\Entities\Ticket;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class CategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepositoryEloquent extends EloquentRepository implements CategoryRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Category::class;


    /**
     * Get Policy Model
     *
     * @return string
     */
    public function getPolicyModel($type = 'tickets'){
        switch ($type) {
            case 'articles':
                    return Article::class;
                break;
            default:
                return Ticket::class;
                break;
        }
    }
}