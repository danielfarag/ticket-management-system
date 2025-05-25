<?php

namespace App\Domain\Ticket\Repositories\Eloquent;

use App\Domain\Ticket\Repositories\Contracts\TicketRepository;
use App\Domain\Ticket\Entities\Ticket;
use App\Domain\Ticket\Entities\Views\TicketView;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class TicketRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TicketRepositoryEloquent extends EloquentRepository implements TicketRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Ticket::class;
    
    /**
     * View Name
     * @var String
     */
    protected $view_class = TicketView::class;
}