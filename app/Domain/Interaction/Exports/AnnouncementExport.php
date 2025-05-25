<?php

namespace App\Domain\Interaction\Exports;

use App\Domain\Interaction\Entities\Announcement;
use App\Domain\Interaction\Http\Resources\Announcement\AnnouncementResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class AnnouncementExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var Announcement
     */
    protected $model = Announcement::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'in'          => $this->faker->randomElement(['dashboard', 'website']),
            'content'     => $this->faker->paragraph(1),
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new AnnouncementResource($model))->resolve();
    }
}