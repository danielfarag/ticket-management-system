<?php

namespace App\Domain\Setting\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\Setting\Repositories\Contracts\BlockIpRepository;
use App\Domain\User\Repositories\Contracts\UserRepository;

class BlockIpImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'blocker'     => ['required', 'exists:users,email'],
        'ip_address'  => ['required', 'unique:block_ips'],
        'reason'      => ['required'],
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

        $blockIpRepository = app()->make(BlockIpRepository::class);
        $userRepository = app()->make(UserRepository::class);

        $user = $userRepository->where('email', $row['blocker'])->first();

        return $blockIpRepository->create([
            'blocker_id'  => $user->id,
            'ip_address'  => $row['ip_address'],
            'reason'      => $row['reason'],
        ]);
    }
}