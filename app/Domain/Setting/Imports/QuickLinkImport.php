<?php

namespace App\Domain\Setting\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\Setting\Repositories\Contracts\QuickLinkRepository;

class QuickLinkImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'title'     => ['required', 'string', 'max:255'],
        'url'       => ['required', 'url'],
        'priority'  => ['required', 'numeric', 'unique:quick_links,priority'],
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
        $quickLinkRepository = app()->make(QuickLinkRepository::class);

        return $quickLinkRepository->create([
            'title'     => $row['title'],
            'url'       => $row['url'],
            'priority'  => $row['priority'],
        ]);
    }
}