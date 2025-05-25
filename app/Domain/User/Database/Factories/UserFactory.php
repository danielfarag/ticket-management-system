<?php

namespace App\Domain\User\Database\Factories;

use App\Domain\User\Entities\Role;
use App\Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'type' => $this->faker->randomElement(['admin', 'agent', 'user']),
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
        ];
    }

    /**
    * Indicate that the user is suspended.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public function agent()
    {
        return $this->state(function (array $attributes){
            return [
                'type' => 'agent',
            ];
        });
    }

    /**
    * Indicate that the user is suspended.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public function user()
    {
        return $this->state(function (array $attributes){
            return [
                'type' => 'user',
            ];
        });
    }

    /**
    * Indicate that the user is suspended.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public function admin()
    {
        return $this->state(function (array $attributes){
            return [
                'type' => 'admin',
            ];
        });
    }

    
    /**
    * Indicate that the user is suspended.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public function active()
    {
        return $this->state(function (array $attributes){
            return [
                'status' => 'active',
            ];
        });
    }
    
    /**
    * Indicate that the user is suspended.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public function inactive()
    {
        return $this->state(function (array $attributes){
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
        return $this->afterCreating(function (User $user) {
            if($user->type != 'user'){
                $user->assignRole(Role::factory()->create()->name);
            }
        });
    }
}