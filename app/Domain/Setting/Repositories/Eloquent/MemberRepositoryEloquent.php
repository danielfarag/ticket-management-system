<?php

namespace App\Domain\Setting\Repositories\Eloquent;

use App\Domain\Setting\Repositories\Contracts\MemberRepository;
use App\Domain\Setting\Entities\Member;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class MemberRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MemberRepositoryEloquent extends EloquentRepository implements MemberRepository
{
    /**
     * Define request files
     * @var array
     */
    protected $images = [];

    /**
     * Model Name
     * @var String
     */
    protected $model_class = Member::class;

    /**
     * Setup repo features
     * Define Filtration Criteria
     *
     * @return void
     */
    public function boot(){
        ###FILTRATION_CRITERIA###
    }
}