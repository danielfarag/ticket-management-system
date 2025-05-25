<?php

namespace App\Domain\Ticket\Exports;

use App\Domain\Ticket\Entities\Severity;
use App\Domain\Ticket\Http\Resources\Severity\SeverityResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class SeverityExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var Severity
     */
    protected $model = Severity::class;

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
        return (new SeverityResource($model))->resolve();
    }
}