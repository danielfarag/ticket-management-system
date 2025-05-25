<?php

namespace App\Domain\Ticket\Entities\Views;

use App\Domain\Ticket\Entities\Traits\CustomAttributes\EscalationAttributes;
use App\Domain\Ticket\Entities\Traits\Relations\EscalationRelations;
use Illuminate\Database\Eloquent\Model;

class EscalationView extends Model
{
    use EscalationRelations, EscalationAttributes;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'escalations_view';
}
