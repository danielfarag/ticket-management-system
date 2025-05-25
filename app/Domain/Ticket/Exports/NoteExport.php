<?php

namespace App\Domain\Ticket\Exports;

use App\Domain\Ticket\Entities\Note;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class NoteExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var Note
     */
    protected $model = Note::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'name'      => $this->faker->words(3),
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return [
            'id'          => $model->id,
            'name'        => $model->name,    
            'created_at'  => $model->created_at,
            'updated_at'  => $model->updated_at,
        ];
    }
}