<?php

namespace App\Domain\Ticket\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\Ticket\Entities\Severity;

class SeverityTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Severity::factory()->create(['name'=>'low', 'color'=>'#88ff53']);
        Severity::factory()->create(['name'=>'average', 'color'=>'#00f3ff']);
        Severity::factory()->create(['name'=>'high', 'color'=>'#fba1a1']);
        Severity::factory()->create(['name'=>'critical', 'color'=>'#f00']);
    }
}
