<?php

namespace App\Domain\Setting\Database\Factories;

use App\Domain\Setting\Entities\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'         => $this->faker->name,
            'title'        => $this->faker->word(),
            'description'  => $this->faker->words(4, true),
        ];
    }
    
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Member $member) {
            $member->addMedia(storage_path('seeder/members/'.random_int(1,4).'.jpg'))->preservingOriginal()->toMediaCollection('image');
        });
    }
}