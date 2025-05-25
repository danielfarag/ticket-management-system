<?php

namespace App\Domain\Ticket\Database\Factories;

use App\Domain\Ticket\Entities\Survey;
use Illuminate\Database\Eloquent\Factories\Factory;

class SurveyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Survey::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'resolved'=>$this->faker->randomElement(['yes', 'no']),
            'comment'=>$this->faker->paragraph(),
        ];
    }
}