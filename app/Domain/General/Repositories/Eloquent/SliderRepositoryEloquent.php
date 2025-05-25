<?php

namespace App\Domain\General\Repositories\Eloquent;

use App\Domain\General\Repositories\Contracts\SliderRepository;
use App\Domain\General\Entities\Slider;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class SliderRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SliderRepositoryEloquent extends EloquentRepository implements SliderRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Slider::class;
}