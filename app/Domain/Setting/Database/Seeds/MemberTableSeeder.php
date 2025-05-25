<?php

namespace App\Domain\Setting\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\Setting\Entities\Member;

class MemberTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Member::factory(16)->create();
    }
}
