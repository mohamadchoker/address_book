<?php

namespace Modules\AddressBook\Entities;


use App\Scopes\UserScope;
use Carbon\Carbon;
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

    public function phones()
    {
        return $this->hasMany(PhoneNumber::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function tags()
    {
        return $this->hasMany(ContactTag::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getAgeAttribute()
    {
        return (!is_null($this->birth_date)) ? Carbon::parse($this->birth_date)->age : '' ;
    }

}
