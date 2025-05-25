<?php

namespace App\Domain\Interaction\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\Interaction\Entities\MailTemplate;

class MailTemplateTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        MailTemplate::factory(5)->create();
    }
}
