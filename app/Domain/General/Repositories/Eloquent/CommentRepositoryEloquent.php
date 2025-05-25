<?php

namespace App\Domain\General\Repositories\Eloquent;

use App\Domain\General\Repositories\Contracts\CommentRepository;
use App\Domain\General\Entities\Comment;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CommentRepositoryEloquent extends EloquentRepository implements CommentRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Comment::class;
}