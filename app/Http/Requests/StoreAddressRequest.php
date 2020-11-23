<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company'=>['required','min:3'],
            'address'=>['required','min:10'],
            'post_code'=>['required','min:4'],
            'city'=>['required','min:3'],
            'country'=>['required','min:2']
        ];
    }
}
