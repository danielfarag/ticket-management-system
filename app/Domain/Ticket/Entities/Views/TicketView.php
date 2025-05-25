<?php

namespace App\Domain\Ticket\Entities\Views;

use App\Domain\Ticket\Entities\Traits\CustomAttributes\TicketAttributes;
use App\Domain\Ticket\Entities\Traits\Relations\TicketRelations;
use Illuminate\Database\Eloquent\Model;

class TicketView extends Model
{
    use TicketRelations, TicketAttributes;
  
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tickets_view';
}
