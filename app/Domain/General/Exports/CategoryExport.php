<?php

namespace App\Domain\General\Exports;

use App\Domain\General\Entities\Category;
use App\Domain\General\Http\Resources\Category\CategoryResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class CategoryExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Build Query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $entity = request('entity',false);
        
        return Category::query()->when($entity, function($query) use($entity){
            $query->where('type', $entity);
        });
    }
    
    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'name'      => $this->faker->word(),
            'status'    => $this->faker->randomElement(['active', 'inactive']),
            'icon'      => $this->faker->randomElement(['lock', 'plus', 'download', 'upload', 'bell', 'eye']),
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new CategoryResource($model))->resolve();
    }
}