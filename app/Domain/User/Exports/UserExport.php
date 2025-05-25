<?php

namespace App\Domain\User\Exports;

use App\Domain\User\Entities\User;
use App\Domain\User\Http\Resources\User\UserResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class UserExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var User
     */
    protected $model = User::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'name'                  =>  $this->faker->name,
            'email'                 =>  $this->faker->email,
            'phone_number'          =>  $this->faker->phoneNumber,
            'password'              =>  'password',
            'type'                  =>  $this->faker->randomElement(['admin', 'agent', 'user']),
            'status'                =>  $this->faker->randomElement(['active', 'inactive']),
            'role'                  =>  $this->faker->word(),
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new UserResource($model))->resolve();
    }
}