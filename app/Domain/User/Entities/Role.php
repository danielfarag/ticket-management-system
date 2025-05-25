<?php

namespace App\Domain\User\Entities;

use App\Domain\User\Entities\Traits\Relations\RoleRelations;
use App\Domain\User\Entities\Traits\CustomAttributes\RoleAttributes;
use App\Domain\User\Repositories\Contracts\RoleRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as Model;

class Role extends Model
{
    use RoleRelations, RoleAttributes, HasFactory;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = 'Role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'guard_name'
    ];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = "roles";

    /**
     * Holds Repository Related to current Model.
     *
     * @var array
     */
    protected $routeRepoBinding = RoleRepository::class;
}
