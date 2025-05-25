<?php

namespace App\Domain\Setting\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\Setting\Repositories\Contracts\MemberRepository;

class MemberImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'name'           => ['required', 'string', 'max:255'],
        'title'          => ['required', 'string', 'max:255'],
        'description'    => ['required', 'string', 'max:255'],
        'image'          => ['nullable', 'string']
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

        $memberRepository = app()->make(MemberRepository::class);

        $member = $memberRepository->create([
            'name'           => $row['name'],
            'title'          => $row['title'],
            'description'    => $row['description'],
        ]);

        if(array_key_exists('image', $row) && !empty($row['image'])){
            $member->addMediaFromUrl($row['image'])->toMediaCollection('image');
        }

        return $member;

    }
}