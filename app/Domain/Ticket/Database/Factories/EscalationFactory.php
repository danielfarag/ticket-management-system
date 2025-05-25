<?php

namespace App\Domain\Ticket\Database\Factories;

use App\Domain\Ticket\Entities\Escalation;
use Illuminate\Database\Eloquent\Factories\Factory;

class EscalationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Escalation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement([ 'pending', 'in_progress', 'solved']),
        ];
    }
}