<?php

namespace App\Http\Requests\Apartements;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
class ApartementUpdateRequest extends FormRequest
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
            'gender'=>'string',
            'max'=>'integer',
            'images'=>'string',
            'nearby'=>'string',
            'price'=>'integer',
            'address'=>'string',
            'description'=>'string',
            'owner_id'=>'integer',
            'city_id'=>'integer'
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
