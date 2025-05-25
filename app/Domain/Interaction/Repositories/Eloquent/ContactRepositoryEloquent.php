<?php

namespace App\Domain\Interaction\Repositories\Eloquent;

use App\Domain\Interaction\Repositories\Contracts\ContactRepository;
use App\Domain\Interaction\Entities\Contact;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class ContactRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ContactRepositoryEloquent extends EloquentRepository implements ContactRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Contact::class;
}