<?php

namespace App\Domain\General\Entities\Views;

use Illuminate\Database\Eloquent\Model;

class TodoView extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'todos_view';
}
