<?php

namespace App\Domain\Cms\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\Cms\Entities\Faq;

class FaqTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Faq::factory(30)->create();
    }
}
