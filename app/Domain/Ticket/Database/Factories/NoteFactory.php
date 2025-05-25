<?php

namespace App\Domain\Ticket\Database\Factories;

use App\Domain\User\Entities\User;
use App\Domain\Ticket\Entities\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Note::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'note' => $this->faker->sentence(),
            'agent_id' => function(){
                return User::factory()->agent()->create()->id;
            },
        ];
    }
}