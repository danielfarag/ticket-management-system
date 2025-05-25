<?php

namespace App\Domain\Ticket\Exports;

use App\Domain\Ticket\Entities\Status;
use App\Domain\Ticket\Http\Resources\Status\StatusResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class StatusExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var Status
     */
    protected $model = Status::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'priority'  => $this->faker->randomDigit,
            'name'      => $this->faker->word(),
            'color'     => $this->faker->hexcolor,
            'status'    => $this->faker->randomElement(['active','inactive']),
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new StatusResource($model))->resolve();
    }
}