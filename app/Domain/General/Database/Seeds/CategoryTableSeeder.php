<?php

namespace App\Domain\General\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\General\Entities\Category;

class CategoryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->ticket()->create(['name'=>'Server Troubleshooting']);
        Category::factory()->ticket()->create(['name'=>'Office - Productivity']);
        Category::factory()->ticket()->create(['name'=>'New User - User Leaving']);
        Category::factory()->ticket()->create(['name'=>'File Storage']);
        Category::factory()->ticket()->create(['name'=>'Issue Diagnosing']);


        Category::factory()->article()->create(['name'=>'Servers']);
        Category::factory()->article()->create(['name'=>'Productivity']);
        Category::factory()->article()->create(['name'=>'Users']);
        Category::factory()->article()->create(['name'=>'Storage']);
    }
}
