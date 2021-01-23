<?php

namespace Modules\AddressBook\Entities;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{

    protected $fillable = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope());
    }

}
