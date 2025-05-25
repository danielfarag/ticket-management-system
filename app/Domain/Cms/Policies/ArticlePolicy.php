<?php

namespace App\Domain\Cms\Policies;

use App\Domain\Cms\Entities\Article;
use App\Domain\User\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('read_article');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Cms\Entities\Article  $article
     * @return mixed
     */
    public function view(User $user, Article $article)
    {
        return $user->can('read_article');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_article');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Cms\Entities\Article  $article
     * @return mixed
     */
    public function update(User $user, Article $article)
    {
        return $user->can('update_article');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Cms\Entities\Article  $article
     * @return mixed
     */
    public function delete(User $user, Article $article)
    {
        return $user->can('delete_article');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Cms\Entities\Article  $article
     * @return mixed
     */
    public function restore(User $user, Article $article)
    {
        return $user->can('restore_article');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Cms\Entities\Article  $article
     * @return mixed
     */
    public function forceDelete(User $user, Article $article)
    {
        return $user->can('force_delete_article');
    }
    
    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domain\User\Entities\User  $user
     * @param  \App\Domain\Ticket\Entities\Ticket  $ticket
     * @return mixed
     */
    public function manageCategories(User $user)
    {
        return $user->can('manage_article_categories');
    }
}
