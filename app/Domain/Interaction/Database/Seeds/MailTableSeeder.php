<?php

namespace App\Domain\Interaction\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\Interaction\Entities\Mail;

class MailTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Mail::factory(60)->create();
    }
}
