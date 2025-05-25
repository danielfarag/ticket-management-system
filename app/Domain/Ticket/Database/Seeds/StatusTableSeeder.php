<?php

namespace App\Domain\Ticket\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\Ticket\Entities\Status;

class StatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Status::factory()->create(['name'=>'pending', 'color'=>'#88ff53']);
        Status::factory()->create(['name'=>'in_progress', 'color'=>'#00f3ff']);
        Status::factory()->create(['name'=>'waiting_customer_reply', 'color'=>'#fad0a1']);
        Status::factory()->create(['name'=>'hold', 'color'=>'#fba1a1']);
        Status::factory()->create(['name'=>'closed', 'color'=>'#f00']);
    }
}
