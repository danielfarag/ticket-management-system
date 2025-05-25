<?php

namespace App\Domain\Ticket\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\Ticket\Entities\Survey;

class SurveyTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Survey::factory(10)->create();
    }
}
