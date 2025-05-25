<?php

namespace App\Domain\General\Exports;

use App\Domain\General\Entities\Service;
use App\Domain\General\Http\Resources\Service\ServiceResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class ServiceExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var Service
     */
    protected $model = Service::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return  [
            'icon'        => $this->faker->randomElement(['lock', 'plus', 'download', 'upload', 'bell', 'eye']),
            'title'       => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'status'      => $this->faker->randomElement(['active', 'inactive']),
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new ServiceResource($model))->resolve();
    }
}