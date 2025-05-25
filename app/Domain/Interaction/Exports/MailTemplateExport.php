<?php

namespace App\Domain\Interaction\Exports;

use App\Domain\Interaction\Entities\MailTemplate;
use App\Domain\Interaction\Http\Resources\MailTemplate\MailTemplateResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class MailTemplateExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var MailTemplate
     */
    protected $model = MailTemplate::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'type'      => $this->faker->randomElement(['new_user','ticket_created']),
            'subject'   => $this->faker->sentence(),
            'body'      => $this->faker->paragraph(),
            'default'   => $this->faker->boolean() ? 1 : 0,
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new MailTemplateResource($model))->resolve();
    }
}