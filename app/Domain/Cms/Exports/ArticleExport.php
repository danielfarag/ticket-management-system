<?php

namespace App\Domain\Cms\Exports;

use App\Domain\Cms\Entities\Article;
use App\Domain\Cms\Http\Resources\Article\ArticleResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class ArticleExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var Article
     */
    protected $model = Article::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'title'         =>  $this->faker->sentence(),
            'body'          =>  $this->faker->paragraph(250),
            'category'      =>  $this->faker->word(),
            'author'        =>  $this->faker->email(),
            'status'        =>  $this->faker->randomElement(['active', 'inactive']),
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new ArticleResource($model))->resolve();
    }
}