<?php

namespace App\Domain\Ticket\Database\Factories;

use App\Domain\General\Entities\Category;
use App\Domain\Ticket\Entities\Department;
use App\Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Department::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }

    /**
     * Indicate that the status in active.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'active',
            ];
        });
     }
    
    /**
     * Indicate that the status in not active.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'inactive',
            ];
        });
    }
    
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Department $department) {
            $department->addMedia(storage_path('seeder/departments/'.random_int(1,6).'.png'))
            ->preservingOriginal()
            ->toMediaCollection('image');

            $department->categories()->attach(Category::factory(random_int(1,2))->create());

            $department->agents()->attach(User::factory()->agent()->create());
        });
    }
}