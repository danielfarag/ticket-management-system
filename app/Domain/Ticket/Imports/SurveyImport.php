<?php

namespace App\Domain\Ticket\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\Ticket\Repositories\Contracts\TicketRepository;

class SurveyImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'ticket'    => ['required', 'exists:tickets,subject'],
        'resolved'  => ['required', 'in:yes,no'],
        'comment'   => ['nullable', 'string', 'max:255'],
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

        $ticketRepository = app()->make(TicketRepository::class);
       
        $ticket = $ticketRepository->where('subject', $row['ticket'])->first();

        $ticket->survey()->delete();

        $survey = $ticket->survey()->create([
            'resolved'    => $row['resolved'],
            'comment'     => $row['comment'],
        ]);

        return $survey;
    }
}