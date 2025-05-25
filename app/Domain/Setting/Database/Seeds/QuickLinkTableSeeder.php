<?php

namespace App\Domain\Setting\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\Setting\Entities\QuickLink;

class QuickLinkTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        QuickLink::factory(5)->create();
    }
}
