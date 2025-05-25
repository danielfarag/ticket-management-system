<?php

namespace App\Domain\Ticket\Exports;

use App\Domain\Ticket\Entities\Survey;
use App\Domain\Ticket\Http\Resources\Survey\SurveyResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class SurveyExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var Survey
     */
    protected $model = Survey::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'ticket'    => $this->faker->sentence(),
            'resolved'  => $this->faker->randomElement(['yes','no']),
            'comment'   => $this->faker->boolean(30) ? $this->faker->sentence() : null,
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new SurveyResource($model))->resolve();
    }
}