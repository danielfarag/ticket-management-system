<?php

namespace App\Domain\General\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\General\Repositories\Contracts\ServiceRepository;

class ServiceImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'icon'         => ['required', 'string', 'max:255'],
        'title'        => ['required', 'string', 'max:255'],
        'description'  => ['required', 'string', 'max:255'],
        'status'       => ['required', 'in:active,inactive'],
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

        $serviceRepository = app()->make(ServiceRepository::class);

        return $serviceRepository->create([
            'icon'         => $row['icon'],
            'title'        => $row['title'],
            'description'  => $row['description'],
            'status'       => $row['status'],
        ]);
    }
}