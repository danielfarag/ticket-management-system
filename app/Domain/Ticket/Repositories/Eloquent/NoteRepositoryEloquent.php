<?php

namespace App\Domain\Ticket\Repositories\Eloquent;

use App\Domain\Ticket\Repositories\Contracts\NoteRepository;
use App\Domain\Ticket\Entities\Note;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class NoteRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class NoteRepositoryEloquent extends EloquentRepository implements NoteRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Note::class;
}