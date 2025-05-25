<?php

namespace App\Domain\Setting\Exports;

use App\Domain\Setting\Entities\BlockIp;
use App\Domain\Setting\Http\Resources\BlockIp\BlockIpResource;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Infrastructure\AbstractExports\BaseExport;

class BlockIpExport extends BaseExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Reference Model
     *
     * @var BlockIp
     */
    protected $model = BlockIp::class;

    /**
    * Return Dummy Data
    */
    public function dummy(){
        return [
            'blocker'      => $this->faker->email,
            'ip_address'   => $this->faker->ipv4,
            'reason'       => $this->faker->paragraph(),
        ];
    }

    /**
    * Return Real Data
    */
    public function real($model){
        return (new BlockIpResource($model))->resolve();
    }
}