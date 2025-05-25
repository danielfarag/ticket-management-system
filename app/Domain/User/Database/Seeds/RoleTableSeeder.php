<?php

namespace App\Domain\User\Database\Seeds;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Domain\User\Repositories\Contracts\RoleRepository;

class RoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        try {
            app()[PermissionRegistrar::class]->forgetCachedPermissions();
            $roleRepository = app()->make(RoleRepository::class);
            $permissions = [];
            collect($roleRepository->permissions)->map(function($group) use(&$permissions){
                $permissions = array_merge($permissions, array_keys($group['permissions']));
            });

            $permissions = collect($permissions)->map(function($permission){
                return ['name'=>$permission, 'guard_name'=>'web'];
            });
            Permission::insert($permissions->toArray());

            $roleRepository
            ->create(['name'=>'admin', 'guard_name'=>'web'])
            ->permissions()->attach(Permission::all());

            $roleRepository
            ->create(['name'=>'agent', 'guard_name'=>'web'])
            ->permissions()->attach($this->getAgentPermissions());

            $roleRepository
            ->create(['name'=>'supervisor', 'guard_name'=>'web'])
            ->permissions()->attach($this->getSupervisorPermissions());

            $roleRepository
            ->create(['name'=>'leader', 'guard_name'=>'web'])
            ->permissions()->attach($this->getLeaderPermissions());
        } catch (\Throwable $th) {}
    }


    private function getSupervisorPermissions(){
        return Permission::query()
        ->where('name', 'LIKE', '%_department')
        ->orWhere('name', 'LIKE', '%_todo')
        ->orWhere('name', 'LIKE', '%_escalation')
        ->get();
    }

    private function getAgentPermissions(){
        return Permission::query()
        ->where('name', 'LIKE', '%_ticket')
        ->orWhere('name', 'LIKE', '%_todo')
        ->orWhere('name', 'LIKE', '%_escalation')
        ->get();
    }

    private function getLeaderPermissions(){
        return Permission::query()
        ->where('name', 'LIKE', '%_ticket')
        ->orWhere('name', 'LIKE', '%_todo')
        ->orWhere('name', 'LIKE', '%_escalation')
        ->orWhere('name', 'LIKE', '%_status')
        ->orWhere('name', 'LIKE', '%_severity')
        ->orWhere('name', 'LIKE', '%_department')
        ->get();
    }

}
