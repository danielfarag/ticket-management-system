<?php

namespace App\Domain\General\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\General\Entities\Todo;

class TodoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Todo::factory(60)->create();
    }
}
