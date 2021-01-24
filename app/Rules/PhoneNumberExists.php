<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class PhoneNumberExists implements Rule
{

    protected $ignore ;

    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public function __construct($ignore)
    {
        $this->ignore = $ignore;
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

        $check =  DB::table('phone_numbers')
            ->leftJoin('contacts',function (JoinClause $join) {
                $join->on('contacts.user_id','=',DB::raw("'".auth()->id()."'"));
            });
        if(!is_null($this->ignore)){
            $check->where('contact_id','!=',$this->ignore);
        }
        $check = $check->where('number',$value)->doesntExist();

        return $check;
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
