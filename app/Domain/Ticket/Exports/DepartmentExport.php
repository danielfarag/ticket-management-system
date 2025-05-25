<?php

namespace App\Domain\Ticket\Exports;

use App\Domain\Ticket\Entities\Department;
use App\Domain\Ticket\Http\Resources\Department\DepartmentResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class DepartmentExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var Department
     */
    protected $model = Department::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'name'         => $this->faker->word(),
            'description'  => $this->faker->sentence(),
            'status'       => $this->faker->randomElement(['active', 'inactive']),
            'categories'   => str_replace(' ', ',', $this->faker->words(4,true)),
            'agents'       => join(',', [$this->faker->email, $this->faker->email, $this->faker->email, $this->faker->email]),
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new DepartmentResource($model))->resolve();
    }
}