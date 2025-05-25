<?php

namespace App\Domain\General\Exports;

use App\Domain\General\Entities\Todo;
use App\Domain\General\Http\Resources\Todo\TodoResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class TodoExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var Todo
     */
    protected $model = Todo::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'agent'       => $this->faker->email,
            'subject'     => $this->faker->sentence(),
            'body'        => $this->faker->paragraph(),
            'priority'    => $this->faker->randomElement(['low', 'medium', 'high']),
            'status'      => $this->faker->randomElement(['done', 'idle', 'todo', 'in_progress', 'urget']),
            'due_at'      => $this->faker->dateTime('+2 years'),
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new TodoResource($model))->resolve();
    }
}