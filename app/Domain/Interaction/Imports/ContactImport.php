<?php

namespace App\Domain\Interaction\Imports;

use App\Domain\Interaction\Repositories\Contracts\ContactRepository;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;

class ContactImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'name'              => ['required', 'string', 'max:255'],
        'email'             => ['required', 'email'],
        'phone_number'      => ['required', 'min:8'],
        'message'           => ['required', 'min:10', 'max:255'],
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

        $contactRepository = app()->make(ContactRepository::class);

        return $contactRepository->create([
            'name'           => $row['name'],
            'email'          => $row['email'],
            'phone_number'   => $row['phone_number'],
            'message'        => $row['message'],
        ]);
    }
}