<?php

namespace App\Domain\Setting\Exports;

use App\Domain\Setting\Entities\QuickLink;
use App\Domain\Setting\Http\Resources\QuickLink\QuickLinkResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class QuickLinkExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var QuickLink
     */
    protected $model = QuickLink::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'title'     => $this->faker->sentence(),
            'url'       => $this->faker->url(),
            'priority'  => $this->faker->randomDigit,
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new QuickLinkResource($model))->resolve();
    }
}