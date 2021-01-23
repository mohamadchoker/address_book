<?php

namespace Modules\AddressBook\Entities;


use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope());
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function phoneNumbers()
    {
        return $this->hasMany(PhoneNumber::class);
    }

}
