<?php

namespace Modules\AddressBook\Http\Requests;

use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rule;

class CreateGroupRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required','string',Rule::unique('groups')->where('user_id',auth()->id())],
            'description' => ['nullable','string']
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
