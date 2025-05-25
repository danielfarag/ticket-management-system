<?php

namespace App\Domain\Ticket\Repositories\Eloquent;

use App\Domain\Ticket\Repositories\Contracts\EscalationRepository;
use App\Domain\Ticket\Entities\Escalation;
use App\Domain\Ticket\Entities\Views\EscalationView;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class EscalationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EscalationRepositoryEloquent extends EloquentRepository implements EscalationRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Escalation::class;

    /**
     * View Name
     * @var String
     */
    protected $view_class = EscalationView::class;

}