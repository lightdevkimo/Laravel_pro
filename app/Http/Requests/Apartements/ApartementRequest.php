<?php

namespace App\Http\Requests\Apartements;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ApartementRequest extends FormRequest
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
            'gender'=>'required|string',
            'max'=>'required|integer',
            'images'=>'required',
            'available'=>'required|integer',
            'nearby'=>'required|string',
            'price'=>'required|integer',
            'address'=>'required|string',
            'description'=>'required|string',
            'owner_id'=>'required',
            'city_id'=>'required'
        ];
    }
    public function withValidator(Validator $validator)
    {
        if ($validator->fails()) {
            abort(response()->json([
                'errors' => $validator->errors()], 402));
        }
    }
}
