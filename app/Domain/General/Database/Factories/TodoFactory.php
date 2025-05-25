<?php

namespace App\Domain\General\Database\Factories;

use App\Domain\User\Entities\User;
use App\Domain\General\Entities\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject'       => $this->faker->sentence(),
            'body'          => $this->faker->sentence(),
            'priority'      => $this->faker->randomElement(['low', 'high', 'medium']),
            'status'        => $this->faker->randomElement(['done', 'idle', 'todo', 'in_progress', 'urget']),
            'agent_id'      => function(){
                return User::factory()->agent()->create()->id;
            },
            'due_at'        => $this->faker->dateTime(),
        ];
    }
}