<?php

namespace App\Domain\Cms\Database\Factories;

use App\Domain\Cms\Entities\Article;
use App\Domain\Cms\Entities\Faq;
use App\Domain\Ticket\Entities\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Faq::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question'=>$this->faker->sentence(),
            'answer'=>$this->faker->sentence(),
            'article_id'=>function(){
                return $this->faker->boolean(30) ?  Article::factory()->create()->id : null;
            },
            'department_id'=>function(){
                return Department::factory()->create()->id;
            },
            'status'=>$this->faker->randomElement(['active', 'inactive'])
        ];
    }
}