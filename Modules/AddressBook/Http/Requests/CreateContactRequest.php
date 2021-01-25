<?php

namespace Modules\AddressBook\Http\Requests;

use App\Http\Requests\ApiRequest;
use App\Rules\PhoneNumberExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateContactRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required','string',
                Rule::unique('contacts')->where('user_id',auth()->id())
            ],
            'first_name' => ['required','string'],
            'last_name' => ['required','string'],
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'location' => ['nullable','string'],
            'job_title' => ['nullable','string'],
            'birth_date' => ['nullable','date'],
            'gender' => ['required'],
            'phones' => ['required','array'],
            'phones.*.number' => ['required','distinct',new PhoneNumberExists(null)],
            'addresses' => ['required','array'],
            'facebook_link' => ['nullable','url', Rule::unique('contacts')->where('user_id',auth()->id())],
            'linkedin_link' => ['nullable','url', Rule::unique('contacts')->where('user_id',auth()->id())],
            'twitter_link' => ['nullable','url', Rule::unique('contacts')->where('user_id',auth()->id())],
            'instagram_link' => ['nullable','url', Rule::unique('contacts')->where('user_id',auth()->id())]

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
