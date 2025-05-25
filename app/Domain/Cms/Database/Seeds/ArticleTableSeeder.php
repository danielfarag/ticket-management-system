<?php

namespace App\Domain\Cms\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\Cms\Entities\Article;

class ArticleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Article::factory(60)->create();
    }
}
