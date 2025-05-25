<?php

namespace App\Domain\Interaction\Database\Factories;

use App\Domain\Interaction\Entities\Mail;
use Illuminate\Database\Eloquent\Factories\Factory;

class MailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email'       => $this->faker->email,
            'subject'     => $this->faker->sentence(),
            'body'        => $this->faker->paragraph(),
            'status'      => $this->faker->randomElement(['pending', 'sent', 'cancelled']),
            'send_at'     => $this->faker->dateTime('+3 years'),
        ];
    }
}