<?php

namespace App\Domain\General\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\General\Repositories\Contracts\CategoryRepository;

class CategoryImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'name'          => ['required', 'string', 'max:255'],
        'status'        => ['required', 'in:active,inactive'],
        'icon'          => ['required'],
    ];

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!$this->isValid($row)){
            return null;
        }

        $categoryRepository = app()->make(CategoryRepository::class);

        $category = $categoryRepository->create([
            'name'      => $row['name'],
            'status'    => $row['status'],
            'icon'      => $row['icon'],
            'type'      => $this->data->entity,
        ]);

        $category->setMeta('icon', $row['icon']);

        return $category;
    }
}