<?php

namespace App\Domain\Interaction\Exports;

use App\Domain\Interaction\Entities\Contact;
use App\Domain\Interaction\Http\Resources\Contact\ContactResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class ContactExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var Contact
     */
    protected $model = Contact::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'name'              => $this->faker->name,
            'email'             => $this->faker->email,
            'phone_number'      => $this->faker->phoneNumber,
            'message'           => $this->faker->paragraphs(2,true),
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new ContactResource($model))->resolve();
    }
}