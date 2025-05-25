<?php

namespace App\Domain\User\Exports;

use App\Domain\User\Entities\Role;
use App\Domain\User\Repositories\Contracts\RoleRepository;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class PermissionExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Build Query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return new class {
            public function get(){
                $permissions = collect([]);
                collect(app()->make(RoleRepository::class)->permissions)->map(function($group) use(&$permissions){
                    $permissions = $permissions->merge(array_keys($group['permissions']));
                });
                return  $permissions;
            }
        };
    }

    /**
     * Reference Model
     *
     * @var Role
     */
    protected $permissions = [];

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'name'   => '',
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return [
            'name'=>$model
        ];
    }
}