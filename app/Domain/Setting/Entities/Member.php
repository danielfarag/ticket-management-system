<?php

namespace App\Domain\Setting\Entities;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\Setting\Repositories\Contracts\MemberRepository;
use App\Domain\Setting\Entities\Traits\Relations\MemberRelations;
use App\Domain\Setting\Entities\Traits\CustomAttributes\MemberAttributes;

class Member extends Model implements HasMedia
{
    use MemberRelations, MemberAttributes, HasFactory, InteractsWithMedia;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Member';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'title',
        'description',
    ];

    /**
     * Appends Custom Attributes To Slider Object.
     *
     * @var array
     */
    protected $appends = ["image"];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "members";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = MemberRepository::class;
}
