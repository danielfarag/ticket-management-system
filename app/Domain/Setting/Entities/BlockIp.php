<?php

namespace App\Domain\Setting\Entities;

use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\Setting\Entities\Traits\Relations\BlockIpRelations;
use App\Domain\Setting\Entities\Traits\CustomAttributes\BlockIpAttributes;
use App\Domain\Setting\Repositories\Contracts\BlockIpRepository;

class BlockIp extends Model
{
    use BlockIpRelations, BlockIpAttributes;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'BlockIp';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'blocker_id',
        'ip_address',
        'reason'
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "block_ips";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = BlockIpRepository::class;
}
