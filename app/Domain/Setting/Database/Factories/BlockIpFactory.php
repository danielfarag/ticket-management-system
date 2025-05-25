<?php

namespace App\Domain\Setting\Database\Factories;

use App\Domain\Setting\Entities\BlockIp;
use App\Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlockIpFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlockIp::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'blocker_id'    => function(){
                return User::factory()->agent()->create()->id;
            },
            'ip_address'    => $this->faker->ipv4(),
            'reason'        => $this->faker->paragraph(),
        ];
    }
}