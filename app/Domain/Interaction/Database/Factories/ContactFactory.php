<?php

namespace App\Domain\Interaction\Database\Factories;

use App\Domain\Interaction\Entities\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->name,
            'email'         => $this->faker->email,
            'phone_number'  => $this->faker->phoneNumber,
            'message'       => $this->faker->paragraph(),
        ];
    }
}