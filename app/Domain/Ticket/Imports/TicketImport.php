<?php

namespace App\Domain\Ticket\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\User\Repositories\Contracts\UserRepository;
use App\Domain\Ticket\Repositories\Contracts\StatusRepository;
use App\Domain\Ticket\Repositories\Contracts\TicketRepository;
use App\Domain\Ticket\Repositories\Contracts\SeverityRepository;
use App\Domain\General\Repositories\Contracts\CategoryRepository;
use Illuminate\Support\Facades\Validator;

class TicketImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'subject'           => ['required', 'string', 'min:10', 'max:255'],
        'body'              => ['required', 'string', 'min:10'],
        'user'              => ['required', 'exists:users,email'],
        'severity'          => ['required', 'exists:severities,name'],
        'category'          => ['required', 'exists:categories,name'],
        'status'            => ['required', 'exists:statuses,name'],
        'solved'            => ['required', 'in:yes,no'],
        'agents'            => ['nullable','string'],
        'attachments'       => ['nullable'],
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
        $severityRepository = app()->make(SeverityRepository::class);
        $statusRepository = app()->make(StatusRepository::class);
        $categoryRepository = app()->make(CategoryRepository::class);

        $user = app()->make(UserRepository::class)->where('email', $row['user'])->first();
        $severity = $severityRepository->where('name', $row['severity'])->first();
        $status = $statusRepository->where('name', $row['status'])->first();
        $category = $categoryRepository->where('name', $row['category'])->first();

        $ticket = $ticketRepository->create([
            'subject'       => $row['subject'],
            'body'          => $row['body'],
            'user_id'       => $user->id,
            'severity_id'   => $severity->id,
            'status_id'     => $status->id,
            'solved'        => $row['solved'],
        ]);

        $ticket->categories()->detach();
        $ticket->categories()->attach($category);

        
        if(array_key_exists('agents', $row) && !empty($row['agents'])){
            $emails = ['emails' => explode(',', $row['agents'])];

            $validator = Validator::make($emails, [
                'emails'       => 'array',
                'emails.*'     => 'exists:users,email',
            ]);
    
            $agents = app()->make(UserRepository::class)->whereIn('email', $emails['emails'])->pluck('id')->toArray();
            if (!$validator->fails()) {
                $ticket->agents()->sync($agents);
            }
        }

        return $ticket;
    }
}