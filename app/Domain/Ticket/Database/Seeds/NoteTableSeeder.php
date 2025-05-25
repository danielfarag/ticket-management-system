<?php

namespace App\Domain\Ticket\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\Ticket\Entities\Note;

class NoteTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Note::factory(1000)->create();
    }
}
