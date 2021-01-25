<?php

namespace Modules\AddressBook\Entities;

use Illuminate\Database\Eloquent\Model;


class ContactTag extends Model
{

    protected $fillable = [];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

}
