<?php

namespace App\Domain\Cms\Database\Factories;

use App\Domain\Cms\Entities\Article;
use App\Domain\General\Entities\Category;
use App\Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->sentence(),
            'body'=>$this->faker->paragraph(250),
            'author_id'=> function(){
                return User::factory()->agent()->create()->id;
            },
            'status'=>$this->faker->randomElement(['active', 'inactive'])
        ];
    }


    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Article $article) {
            $categories = Category::factory(random_int(1,4))->article()->create();
            
            $article->categories()->attach($categories);

            $article->addMedia(storage_path('seeder/articles/'.random_int(1,4).'.jpg'))->preservingOriginal()->toMediaCollection('image');
        });
    }
}