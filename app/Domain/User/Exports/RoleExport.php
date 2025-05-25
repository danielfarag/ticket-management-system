<?php

namespace App\Domain\User\Exports;

use App\Domain\User\Entities\Role;
use App\Domain\User\Http\Resources\Role\RoleResource;
use App\Domain\User\Repositories\Contracts\RoleRepository;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class RoleExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var Role
     */
    protected $model = Role::class;

    /**
     * Reference Model
     *
     * @var Role
     */
    protected $permissions = [];

    /**
     * Define
     *
     * @param boolean $dummy
     */
    public function __construct($dummy = true){
        parent::__construct($dummy);

        $this->permissions = collect([]);
        
        collect(app()->make(RoleRepository::class)->permissions)->map(function($group){
            $this->permissions = $this->permissions->merge(array_keys($group['permissions']));
        });
    }

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'name'          => $this->faker->word(),
            'permissions'   => join(',', $this->faker->randomElements($this->permissions, $this->faker->randomDigitNotNull())),
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new RoleResource($model))->resolve();
    }
}