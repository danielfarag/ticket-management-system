<?php

namespace App\Domain\Setting\Database\Factories;

use App\Domain\Setting\Entities\QuickLink;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuickLinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuickLink::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'     => $this->faker->words(2, true),
            'url'       => $this->faker->url(),
            'priority'  => $this->faker->randomDigit(),
        ];
    }
}