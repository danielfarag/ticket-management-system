<?php

namespace App\Domain\Interaction\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\Interaction\Repositories\Contracts\MailRepository;

class MailImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'email'      => ['required'],
        'subject'    => ['required', 'string', 'max:255'],
        'body'       => ['required', 'string'],
        'status'     => ['required', 'in:pending,sent,cancelled'],
        'send_at'    => ['required', 'date', 'after:now'],
    ];

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!$this->isValid($row) && !$this->validEmails($row)){
            return null;
        }

        $mailRepository = app()->make(MailRepository::class);

        return $mailRepository->create([
            'email'        => $row['email'],
            'subject'      => $row['subject'],
            'body'         => $row['body'],
            'status'       => $row['status'],
            'send_at'      => $row['send_at'],
        ]);
    }

    /**
     * Check if valid
     *
     * @param [type] $data
     * @return void
     */
    private function validEmails($data){

        $emails = ['email' => explode(',', $data['email'])];

        $validator = Validator::make($emails, [
            'email'       => 'array',
            'email.*'     => 'exists:email,name',
        ]);

        return !$validator->fails();

    }
}