<?php

namespace Modules\AddressBook\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhoneNumber extends Model
{

    protected $fillable = [];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

}
