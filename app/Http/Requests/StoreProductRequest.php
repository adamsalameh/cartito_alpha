<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'title'=>['required','min:3'],
            'description'=>['required','min:10'],
            'tag'=>['required','min:3'],
            'quantity'=>['required','numeric','min:1'],
            'price'=>['required','numeric','min:1'],
            'sub_category_id'=>['required'],
            'brand_id'=>['required'],
            'in_stock'  => ['boolean']
        ];
    }
}
