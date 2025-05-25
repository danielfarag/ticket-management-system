<?php

namespace App\Domain\Interaction\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\Interaction\Repositories\Contracts\MailTemplateRepository;

class MailTemplateImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'type'     => ['required', 'string', 'in:new_user,ticket_created'],
        'subject'  => ['required', 'string', 'max:255'],
        'body'     => ['required', 'string'],
        'default'  => ['required', 'boolean'],
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
        $mailTemplateRepository = app()->make(MailTemplateRepository::class);

        return $mailTemplateRepository->create([
            'type'     => $row['type'],
            'subject'  => $row['subject'],
            'body'     => $row['body'],
            'default'  => $row['default'],
        ]);
    }
}