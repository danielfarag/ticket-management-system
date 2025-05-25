<?php

namespace App\Domain\General\Database\Factories;

use App\Domain\General\Entities\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'    => $this->faker->words(3, true),
            'subtitle' => $this->faker->sentence(10),
            'link'     => $this->faker->url(),
            'button'   => $this->faker->words(2, true),
            'status'   => $this->faker->randomElement(['active', 'inactive'])
        ];
    }

    
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Slider $slider) {
            $slider->addMedia(storage_path('seeder/sliders/'.random_int(1,4).'.jpg'))->preservingOriginal()->toMediaCollection('image');
        });
    }
}