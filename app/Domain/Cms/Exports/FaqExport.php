<?php

namespace App\Domain\Cms\Exports;

use App\Domain\Cms\Entities\Faq;
use App\Domain\Cms\Http\Resources\Faq\FaqResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class FaqExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var Faq
     */
    protected $model = Faq::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'question'      =>  $this->faker->sentence(),
            'answer'        =>  $this->faker->sentence(),
            'article'       =>  $this->faker->boolean(30) ?  $this->faker->sentence() :null,
            'department'    =>  $this->faker->word(),
            'status'        =>  $this->faker->randomElement(['active', 'inactive'])
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new FaqResource($model))->resolve();
    }
}