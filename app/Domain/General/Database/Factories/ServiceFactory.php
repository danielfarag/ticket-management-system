<?php

namespace App\Domain\General\Database\Factories;

use App\Domain\General\Entities\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'icon' => $this->faker->randomElement(['lock', 'plus', 'download', 'upload', 'bell']),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->sentences(10,true),
            'status' => $this->faker->randomElement(['active', 'inactive'])
        ];
    }
}