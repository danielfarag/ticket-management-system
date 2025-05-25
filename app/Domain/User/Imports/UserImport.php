<?php

namespace App\Domain\User\Imports;

use App\Domain\User\Repositories\Contracts\UserRepository;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use Illuminate\Support\Str;

class UserImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'name'          =>  ['required','min:3','max:24'],
        'email'         =>  ['required','email','unique:users,email'],
        'phone_number'  =>  ['required','min:3','max:24'],
        'password'      =>  ['required','min:3','max:24'],
        'type'          =>  ['required','in:admin,agent,user'],
        'status'        =>  ['required','in:active,inactive'],
        'role'          =>  ['nullable','exists:roles,name'],
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

        $userRepository = app()->make(UserRepository::class);

        $user = $userRepository->create([
            'name'              => $row['name'],
            'email'             => $row['email'],
            'phone_number'      => $row['phone_number'],
            'password'          => $row['password'],
            'type'              => $row['type'],
            'status'            => $row['status'],
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
        ]);

        $user->assignRole($row['role']);

        return $user;
    }
}