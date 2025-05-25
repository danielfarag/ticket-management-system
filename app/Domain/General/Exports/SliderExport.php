<?php

namespace App\Domain\General\Exports;

use App\Domain\General\Entities\Slider;
use App\Domain\General\Http\Resources\Slider\SliderResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class SliderExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var Slider
     */
    protected $model = Slider::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'subtitle' => $this->faker->sentence(),
            'title' => $this->faker->words(2,true),
            'button' => $this->faker->words(2, true),
            'link' => $this->faker->url,
            'status' => $this->faker->randomElement(['active','inactive']),
            'image' => $this->faker->imageUrl(),
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new SliderResource($model))->resolve();
    }
}