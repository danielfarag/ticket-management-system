<?php

namespace App\Domain\Setting\Imports;

use App\Domain\Setting\Repositories\Contracts\SettingRepository;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;

class SettingImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'key'   =>  ['required'],
        'value' =>  ['required'],
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

        $settingRepository = app()->make(SettingRepository::class);

        return $settingRepository->updateOrCreate([
            'key'    => $row['key'],
        ],[
            'value'  => $row['value'],
        ]);
    }
}