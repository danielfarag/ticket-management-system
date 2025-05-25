<?php

namespace App\Domain\Ticket\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\Ticket\Entities\Department;

class DepartmentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Department::factory()->active()->create(['name'=>'Your Account']);
        Department::factory()->active()->create(['name'=>'Copyrights']);
        Department::factory()->active()->create(['name'=>'Tax & Compalince']);
        Department::factory()->active()->create(['name'=>'Purchasing Item']);
        Department::factory()->active()->create(['name'=>'Licensing']);
        Department::factory()->active()->create(['name'=>'Affilates']);
    }
}
