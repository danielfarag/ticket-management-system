<?php

namespace App\Domain\Ticket\Database\Factories;

use App\Domain\General\Entities\Category;
use App\Domain\General\Entities\Comment;
use App\Domain\Ticket\Entities\Escalation;
use App\Domain\Ticket\Entities\Note;
use App\Domain\Ticket\Entities\Severity;
use App\Domain\Ticket\Entities\Status;
use App\Domain\Ticket\Entities\Survey;
use App\Domain\Ticket\Entities\Ticket;
use App\Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject'=>$this->faker->sentence(),
            'body'=>$this->faker->paragraphs(4, true),
            'user_id'=>function(){
                return User::factory()->create()->id;
            },
            'severity_id'=>function(){
                return Severity::factory()->create()->id;
            },
            'status_id'=>function(){
                return Status::factory()->create()->id;
            },
            'solved'=>$this->faker->randomElement(['yes', 'no']),
        ];
    }

    
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Ticket $ticket) {
            $category = Category::factory($this->faker->numberBetween(0, 5))->ticket()->create();
            $ticket->categories()->attach($category);
            
            
            $notes = Note::factory($this->faker->numberBetween(0, 5))->make();
            $ticket->notes()->saveMany($notes);

            $comments = Comment::factory($this->faker->numberBetween(0, 5))->make();
            $ticket->comments()->saveMany($comments);

            $agents = User::factory($this->faker->numberBetween(1, 3))->agent()->create();
            $ticket->agents()->sync($agents);

            if($this->faker->boolean(40)){
                $ticket->escalation()->save(Escalation::factory()->make([
                    'creator_id' => $agents->first()->id
                ]));
            }

            if($this->faker->boolean(40)){
                $ticket->survey()->save(Survey::factory()->make());
            }
        });
    }
}