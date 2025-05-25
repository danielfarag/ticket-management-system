<?php

namespace App\Domain\General\Database\Factories;

use App\Domain\General\Entities\Comment;
use App\Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'   => function(){
                return User::factory()->create()->id;
            },
            'comment'   => $this->faker->paragraph(),
        ];
    }
}