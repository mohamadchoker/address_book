<?php

namespace Modules\AddressBook\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

}
