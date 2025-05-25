<?php

namespace App\Domain\Ticket\Exports;

use App\Domain\Ticket\Entities\Ticket;
use App\Domain\Ticket\Http\Resources\Ticket\TicketResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class TicketExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var Ticket
     */
    protected $model = Ticket::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'subject'   => $this->faker->sentence(),
            'body'      => $this->faker->paragraph(),
            'user'      => $this->faker->email,
            'severity'  => $this->faker->word(),
            'status'    => $this->faker->word(),
            'category'  => $this->faker->word(),
            'agents'    => join(',', [$this->faker->email, $this->faker->email, $this->faker->email]),
            'solved'    => $this->faker->randomElement(['yes', 'no']),
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new TicketResource($model))->resolve();
    }
}