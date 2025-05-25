<?php

namespace App\Domain\Cms\Entities;

use App\Infrastructure\AbstractModels\BaseModel as Model;
use App\Domain\Cms\Entities\Traits\Relations\FaqRelations;
use App\Domain\Cms\Entities\Traits\CustomAttributes\FaqAttributes;
use App\Domain\Cms\Repositories\Contracts\FaqRepository;

class Faq extends Model
{
    use FaqRelations, FaqAttributes;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Faq';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
        'answer',
        'status',
        'article_id',
        'department_id',
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "faqs";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = FaqRepository::class;
}
