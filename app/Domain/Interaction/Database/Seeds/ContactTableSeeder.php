<?php

namespace App\Domain\Interaction\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\Interaction\Entities\Contact;

class ContactTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Contact::factory(60)->create();
    }
}
