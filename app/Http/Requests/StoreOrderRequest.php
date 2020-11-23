<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'first_name'=>['required','min:3'],
            'last_name'=>['required','min:3'],
            'email'=>['required'],
            'telephone'=>['required','min:3'],
            'address'=>['required','min:7'],
            'post_code'=>['required','min:3'],
            'city'=>['required','min:3'],
            'country'=>['required','min:3'],           
            'shipping_method_id'=>['required'],
            'payment_method'=>['required']
        ];
    }
}
