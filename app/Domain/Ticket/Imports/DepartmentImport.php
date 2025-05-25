<?php

namespace App\Domain\Ticket\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\General\Repositories\Contracts\CategoryRepository;
use App\Domain\Ticket\Repositories\Contracts\DepartmentRepository;
use App\Domain\User\Repositories\Contracts\UserRepository;

class DepartmentImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'name'         => ['required', 'string', 'max:255'],
        'description'  => ['required', 'string', 'max:255'],
        'status'       => ['required', 'in:active,inactive'],
        'image'        => ['nullable', 'image'],
        'categories'   => ['required'],
        'agents'       => ['nullable', 'string'],
    ];

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!$this->isValid($row) || $this->categoriesInvalid($row) || $this->agentsInvalid($row)){
            return null;
        }

        $departmentRepository = app()->make(DepartmentRepository::class);
        $categoryRepository = app()->make(CategoryRepository::class);
        $userRepository = app()->make(UserRepository::class);

        $department = $departmentRepository->create([
            'name'         => $row['name'],
            'description'  => $row['description'],
            'status'       => $row['status'],
        ]);

        $categories = $categoryRepository->whereIn('name', explode(',',$row['categories']))->where('type','tickets')->get();
       
        $department->categories()->attach($categories);

        $agents = $userRepository->whereIn('email', explode(',',$row['agents']))->get();
       
        $department->agents()->sync($agents);

        return $department;
    }

    private function categoriesInvalid($row){

        $categories = ['categories'=>explode(',',$row['categories'])];

        $validator = Validator::make($categories, [
            'categories'       => 'array',
            'categories.*'     => 'exists:categories,name',
        ]);

        return $validator->fails();
    }

    private function agentsInvalid($row){

        $agents = ['agents'=>explode(',',$row['agents'])];

        $validator = Validator::make($agents, [
            'agents'       => 'array',
            'agents.*'     => 'exists:users,email',
        ]);

        return $validator->fails();
    }
    
}