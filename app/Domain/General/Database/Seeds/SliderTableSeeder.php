<?php

namespace App\Domain\General\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\General\Entities\Slider;

class SliderTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Slider::factory(6)->create();
    }
}
