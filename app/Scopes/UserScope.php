<?php


namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Modules\AddressBook\Entities\Contact;
use Modules\AddressBook\Entities\Group;
use Modules\AddressBook\Entities\Tag;

class UserScope implements Scope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */

    public function apply(Builder $builder, Model $model)
    {
        if( $model instanceof Contact){
            $builder->where('contacts.user_id',auth()->id());
        }
        if( $model instanceof Group){
            $builder->where('groups.user_id',auth()->id());
        }
        if( $model instanceof Tag){
            $builder->where('tags.user_id',auth()->id());
        }
    }
}
