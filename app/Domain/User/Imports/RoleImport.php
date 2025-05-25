<?php

namespace App\Domain\User\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\User\Repositories\Contracts\RoleRepository;

class RoleImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'name'          =>  ['required','min:3','max:24', 'unique:roles,name'],
        'permissions'   =>  ['nullable','string'],
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

        $roleRepository = app()->make(RoleRepository::class);

        $role = $roleRepository->create([
            'name'      => $row['name'],
            'guard'     => 'web',
        ]);

        if(array_key_exists('permissions', $row) && !empty($row['permissions'])){
            $permissions = ['permissions' => explode(',', $row['permissions'])];

            $validator = Validator::make($permissions, [
                'permissions'       => 'array',
                'permissions.*'     => 'exists:permissions,name',
            ]);
    
            if (!$validator->fails()) {
                $role->syncPermissions($permissions);
            }
        }

        return $role;
    }
}