<?php

namespace App\Domain\Cms\Repositories\Eloquent;

use App\Domain\Cms\Repositories\Contracts\FaqRepository;
use App\Domain\Cms\Entities\Faq;
use App\Domain\Cms\Entities\Views\FaqView;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class FaqRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FaqRepositoryEloquent extends EloquentRepository implements FaqRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Faq::class;
    
    /**
     * View Name
     * @var String
     */
    protected $view_class = FaqView::class;
}