<?php

namespace Modules\AddressBook\Entities;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope());
    }

}
