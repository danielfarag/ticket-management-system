<?php

namespace App\Infrastructure\AbstractModels;

use App\Infrastructure\AbstractRepositories\RepositoryModelBinding;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

abstract class BaseModel extends Model
{
    use HasFactory, RepositoryModelBinding;

    /**
     * @var array
     */
    public static $logAttributes = ["*"];

    /**
     * The attributes that are going to be logged.
     *
     * @var array
     */
    protected static $logName = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The table name.
     *
     * @var array
     */
    protected $table = null;
}