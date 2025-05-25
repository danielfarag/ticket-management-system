<?php

namespace App\Domain\General\Database\Factories;

use App\Domain\General\Entities\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'type' => $this->faker->randomElement(['articles', 'tickets']),
            'status' => $this->faker->randomElement(['active', 'inactive'])
        ];
    }

    /**
    * Indicate that the user is suspended.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
   public function active()
   {
       return $this->state(function (array $attributes) {
           return [
               'status' => 'active',
           ];
       });
    }
   
    /**
    * Indicate that the user is suspended.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'inactive',
            ];
        });
    }
    
    /**
    * Indicate that the user is suspended.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public function article()
    {
        return $this->state(function (array $attributes){
            return [
                 'type' => 'articles',
            ];
        });
    }

    /**
    * Indicate that the user is suspended.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public function ticket()
    {
        return $this->state(function (array $attributes){
            return [
                 'type' => 'tickets',
            ];
        });
    }

    
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
            $category->setMeta('icon', $this->faker->randomElement(['lock', 'plus', 'download', 'upload', 'bell']));
        });
    }

}