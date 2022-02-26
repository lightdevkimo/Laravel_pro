<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApartementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'gender'=>['required'],
            'max'=>['required'],
            'images'=>['required'],
            'nearby'=>['required'],
            'price'=> ['required'],
            'address'=> ['required'],
            'description'=> ['required'],
            'owner_id'=>['required'],
            'city_id'=>['required']
        ];
    }
}
