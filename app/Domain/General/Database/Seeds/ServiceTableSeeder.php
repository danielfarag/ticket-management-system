<?php

namespace App\Domain\General\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\General\Entities\Service;

class ServiceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Service::factory(30)->create();
    }
}
