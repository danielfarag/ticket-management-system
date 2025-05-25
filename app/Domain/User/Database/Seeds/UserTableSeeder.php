<?php

namespace App\Domain\User\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\User\Entities\User;

class UserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        try {
            User::factory()->active()->admin()->create(['name' => 'Admin', 'email' => 'admin@domain.com'])->assignRole('admin');
            User::factory()->active()->agent()->create(['name' => 'Agent', 'email' => 'agent@domain.com'])->assignRole('agent');
            User::factory()->active()->agent()->create(['name' => 'Supervisor', 'email' => 'supervisor@domain.com'])->assignRole('supervisor');
            User::factory()->active()->agent()->create(['name' => 'Leader', 'email' => 'leader@domain.com'])->assignRole('leader');
            User::factory()->active()->user()->create(['name' => 'User', 'email' => 'user@domain.com']);
        } catch (\Throwable $th) {}

        User::factory(50)->create();
    }
}
