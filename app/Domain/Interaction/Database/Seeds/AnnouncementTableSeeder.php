<?php

namespace App\Domain\Interaction\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\Interaction\Entities\Announcement;

class AnnouncementTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Announcement::factory(10)->create();
    }
}
