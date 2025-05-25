<?php

namespace App\Domain\Ticket\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Domain\Ticket\Entities\Severity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\Ticket\Repositories\Contracts\SeverityRepository;

class SeverityImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'name'      => ['required', 'string', 'max:255', 'unique:severities,name'],
        'priority'  => ['required', 'numeric', 'max:255', 'unique:severities,priority'],
        'color'     => ['required', 'string', 'unique:severities,color'],
        'status'    => ['required', 'in:active,inactive'],
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

        $severityRepository = app()->make(SeverityRepository::class);

        $severity = $severityRepository->create([
            'name'      => $row['name'],
            'priority'  => $row['priority'],
            'color'     => $row['color'],
            'status'    => $row['status'],
        ]);

        return $severity;
    }
}