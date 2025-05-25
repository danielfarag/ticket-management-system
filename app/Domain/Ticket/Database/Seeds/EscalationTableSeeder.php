<?php

namespace App\Domain\Ticket\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\Ticket\Entities\Escalation;

class EscalationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Escalation::factory(30)->create();
    }
}
