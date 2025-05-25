<?php

namespace App\Domain\User\Entities;

use Illuminate\Notifications\Notifiable;
use App\Domain\User\Entities\Traits\Relations\UserRelations;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Domain\User\Entities\Traits\CustomAttributes\UserAttributes;
use App\Domain\User\Repositories\Contracts\UserRepository;
use App\Infrastructure\AbstractRepositories\RepositoryModelBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, UserRelations, UserAttributes, HasFactory, InteractsWithMedia, HasRoles, RepositoryModelBinding;
    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'User';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'type',
        'status',
        'email_verified_at',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'activation_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The tatributes that should be appended to native types.
     *
     * @var array
     */
    protected $appends = [
        'role',
    ];

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = UserRepository::class;

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'users.'.$this->id;
    }
}
