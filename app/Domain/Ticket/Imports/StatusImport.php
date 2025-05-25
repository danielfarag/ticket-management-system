<?php

namespace App\Domain\Ticket\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\Ticket\Repositories\Contracts\StatusRepository;

class StatusImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'name'      => ['required', 'string', 'max:255', 'unique:statuses,name'],
        'priority'  => ['required','numeric', 'unique:statuses,priority', 'max:255'],
        'color'     => ['required','string', 'unique:statuses,color'],
        'status'    => ['required','in:active,inactive'],
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

        $statusRepository = app()->make(StatusRepository::class);

        $status = $statusRepository->create([
            'name'      => $row['name'],
            'priority'  => $row['priority'],
            'color'     => $row['color'],
            'status'    => $row['status'],
        ]);

        return $status;
    }
}