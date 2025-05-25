<?php

namespace App\Domain\Interaction\Database\Factories;

use App\Domain\Interaction\Entities\MailTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class MailTemplateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MailTemplate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type'=>$this->faker->randomElement(['new_user', 'ticket_created']),
            'subject'=>$this->faker->sentence(),
            'body'=>$this->faker->paragraph(),
            'default' => $this->faker->boolean(),
        ];
    }
}