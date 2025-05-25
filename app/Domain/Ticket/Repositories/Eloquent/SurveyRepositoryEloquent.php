<?php

namespace App\Domain\Ticket\Repositories\Eloquent;

use App\Domain\Ticket\Repositories\Contracts\SurveyRepository;
use App\Domain\Ticket\Entities\Survey;
use App\Domain\Ticket\Entities\Views\SurveyView;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class SurveyRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SurveyRepositoryEloquent extends EloquentRepository implements SurveyRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Survey::class;

    /**
     * View Name
     * @var String
     */
    protected $view_class = SurveyView::class;
}