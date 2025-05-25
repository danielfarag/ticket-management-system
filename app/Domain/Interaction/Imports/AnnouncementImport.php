<?php

namespace App\Domain\Interaction\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\Interaction\Repositories\Contracts\AnnouncementRepository;

class AnnouncementImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'in'        => ['required', 'in:dashboard,website'],
        'content'   => ['required', 'string', 'max:255'],
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
        
        $announcementRepository = app()->make(AnnouncementRepository::class);

        return $announcementRepository->create([
            'in'        => $row['in'],
            'content'   => $row['content'],
        ]);
    }
}