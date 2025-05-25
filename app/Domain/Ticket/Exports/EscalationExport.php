<?php

namespace App\Domain\Ticket\Exports;

use App\Domain\Ticket\Entities\Escalation;
use App\Domain\Ticket\Http\Resources\Escalation\EscalationResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class EscalationExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var Escalation
     */
    protected $model = Escalation::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'creator'   => $this->faker->email,
            'ticket'    => $this->faker->sentence(),
            'body'      => $this->faker->paragraphs(3, true),
            'status'    => $this->faker->randomElement(['pending','in_progress','solved']),
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new EscalationResource($model))->resolve();
    }
}