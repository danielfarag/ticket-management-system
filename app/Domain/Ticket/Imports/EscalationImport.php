<?php

namespace App\Domain\Ticket\Imports;

use App\Domain\Ticket\Repositories\Contracts\TicketRepository;
use App\Domain\User\Repositories\Contracts\UserRepository;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;

class EscalationImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'ticket'    => ['required', 'exists:tickets,subject'],
        'creator'   => ['required', 'exists:users,email'],
        'body'      => ['required', 'string', 'min:10'],
        'status'    => ['required', 'in:pending,in_progress,solved'],
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

        $ticket = $ticketRepository->where('subject', $row['ticket'])->first();
        $user = $userRepository->where('email', $row['creator'])->first();

        $ticket->escalation()->delete();

        $escalation = $ticket->escalation()->create([
            'creator_id'     => $user->id,
            'body'           => $row['body'],
            'status'         => $row['status'],
        ]);

        return $escalation;
    }
}