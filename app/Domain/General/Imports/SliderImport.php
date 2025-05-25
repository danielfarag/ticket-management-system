<?php

namespace App\Domain\General\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\General\Repositories\Contracts\SliderRepository;

class SliderImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'subtitle'  =>   ['required', 'min:3', 'max:255'],
        'title'     =>   ['required', 'min:3', 'max:255'],
        'button'    =>   ['required', 'min:3', 'max:255'],
        'link'      =>   ['required', 'string', 'url'],
        'status'    =>   ['required', 'in:active,inactive'],
        'image'     =>   ['nullable', 'string']
    ];

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!$this->isValid($row)){
            return null;
        }

        $sliderRepository = app()->make(SliderRepository::class);

        $slider =  $sliderRepository->create([
            'subtitle'  => $row['subtitle'],
            'title'     => $row['title'],
            'button'    => $row['button'],
            'link'      => $row['link'],
            'status'    => $row['status'],
        ]);

        if(array_key_exists('image', $row) && !empty($row['image'])){
            $slider->addMediaFromUrl($row['image'])->toMediaCollection('image');
        }

        return $slider;
    }
}