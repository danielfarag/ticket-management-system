<?php

namespace App\Domain\Setting\Exports;

use App\Domain\Setting\Entities\Member;
use App\Domain\Setting\Http\Resources\Member\MemberResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class MemberExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var Member
     */
    protected $model = Member::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'name'          => $this->faker->name,
            'title'         => $this->faker->word(),
            'description'   => $this->faker->words(6, true),
            'image'         => $this->faker->imageUrl(),
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new MemberResource($model))->resolve();
    }
}