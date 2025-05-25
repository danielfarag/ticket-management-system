<?php

namespace App\Domain\Interaction\Database\Factories;

use App\Domain\Interaction\Entities\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'in' => $this->faker->randomElement(['dashboard', 'website']),
            'content' => $this->faker->sentence(),
        ];
    }
}