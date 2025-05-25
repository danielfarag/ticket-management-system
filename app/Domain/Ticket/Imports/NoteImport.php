<?php

namespace App\Domain\Ticket\Imports;

use App\Domain\Ticket\Entities\Note;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\Ticket\Repositories\Contracts\TicketRepository;

class NoteImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'ticket'    => ['required', 'exists:tickets,title'],
        'agent'     => ['required', 'exists:users,email'],
        'note'      => ['required', 'string', 'min:10'],
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
        $userRepository = app()->make(UserRepository::class);
        $noteRepository = app()->make(NoteRepository::class);

        $ticket = $ticketRepository->where('title', $row['ticket'])->first();
        $agent = $userRepository->where('email', $row['agent'])->first();

        $note = $noteRepository->create([
            'ticket_id'  => $ticket->id,
            'agent_id'   => $agent->id,
            'note'       => $row['note'],
        ]);

        return $note;
    }
}