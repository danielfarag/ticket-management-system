<?php

namespace App\Domain\General\Entities;

use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\General\Entities\Traits\Relations\SliderRelations;
use App\Domain\General\Entities\Traits\CustomAttributes\SliderAttributes;
use App\Domain\General\Repositories\Contracts\SliderRepository;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Slider extends Model implements HasMedia
{
    use SliderRelations, SliderAttributes, InteractsWithMedia;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Slider';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subtitle',
        'title',
        'button',
        'link',
        'status',
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "sliders";

    /**
     * Appends Custom Attributes To Slider Object.
     *
     * @var array
     */
    protected $appends = ["image"];

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = SliderRepository::class;
}
