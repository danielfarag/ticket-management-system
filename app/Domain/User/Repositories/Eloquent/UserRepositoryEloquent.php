<?php

namespace App\Domain\User\Repositories\Eloquent;

use App\Domain\User\Repositories\Contracts\UserRepository;
use App\Domain\User\Entities\User;
use App\Domain\User\Entities\Views\UserView;
use App\Domain\User\Events\UserCreatedEvent;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends EloquentRepository implements UserRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = User::class;

    /**
     * View Name
     * @var String
     */
    protected $view_class = UserView::class;

    /**
     * Save a new entity in repository
     *
     * @param array $attributes
     *
     * @return mixed
     * @throws ValidatorException
     *
     */
    public function create(array $attributes){
        $user = parent::create($attributes);
        
        event(new UserCreatedEvent($user));

        return $user;
    }
}