<?php

namespace App\Domain\General\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\User\Repositories\Contracts\UserRepository;

class TodoImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'subject'   =>  ['required', 'min:3', 'max:255'],
        'body'      =>  ['required', 'min:3', 'max:255'],
        'priority'  =>  ['required', 'in:low,high,medium'],
        'status'    =>  ['required', 'in:done,idle,todo,in_progress,urget'],
        'agent'     =>  ['required', 'exists:users,email'],
        'due_at'    =>  ['required', 'date'],
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

        $userRepository = app()->make(UserRepository::class)->where('email', $row['agent'])->first();
        
        return $userRepository->todos()->create($row);
    }
}