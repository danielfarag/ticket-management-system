<?php

namespace App\Domain\General\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\General\Entities\Comment;

class CommentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Comment::factory(1000)->create();
    }
}
