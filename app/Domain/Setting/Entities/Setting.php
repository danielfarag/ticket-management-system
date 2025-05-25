<?php

namespace App\Domain\Setting\Entities;

use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\Setting\Entities\Traits\Relations\SettingRelations;
use App\Domain\Setting\Entities\Traits\CustomAttributes\SettingAttributes;
use App\Domain\Setting\Repositories\Contracts\SettingRepository;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use SettingRelations, SettingAttributes, InteractsWithMedia;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Setting';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value'
    ];

    /**
     * Appends Custom Attributes To Slider Object.
     *
     * @var array
     */
    protected $appends = [
        "logo"
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "settings";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = SettingRepository::class;
}
