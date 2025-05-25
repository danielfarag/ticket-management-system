<?php

namespace App\Domain\Setting\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\Setting\Entities\BlockIp;

class BlockIpTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        BlockIp::factory(60)->create();
    }
}
