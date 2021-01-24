<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class PhoneNumberExists implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        return DB::table('phone_numbers')
            ->leftJoin('contacts',function (JoinClause $join) {
                $join->on('contacts.user_id','=',DB::raw("'".auth()->id()."'"));
            })
            ->where('number',$value)
            ->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The phone number already exists.';
    }
}
