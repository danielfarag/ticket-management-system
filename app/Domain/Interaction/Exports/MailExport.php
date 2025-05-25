<?php

namespace App\Domain\Interaction\Exports;

use App\Domain\Interaction\Entities\Mail;
use App\Domain\Interaction\Http\Resources\Mail\MailResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class MailExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var Mail
     */
    protected $model = Mail::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'email'        => join(',', [$this->faker->email, $this->faker->email, $this->faker->email]),
            'subject'      => $this->faker->sentence(),
            'body'         => $this->faker->paragraph(),
            'status'       => $this->faker->randomElement(['pending', 'sent', 'cancelled']),
            'send_at'      => $this->faker->dateTimeBetween('+2 days', '+2 months'),
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new MailResource($model))->resolve();
    }
}