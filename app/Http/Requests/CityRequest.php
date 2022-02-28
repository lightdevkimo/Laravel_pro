<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
class CityRequest extends FormRequest
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
            'name' => 'required|string',
            'governorate' =>'required|string'
        ];

    
    }

    public function withValidator(Validator $validator)
    {
        if ($validator->fails()) {
            abort(response()->json([ 
                'success' => false,
                'errors' => $validator->errors()

            ],400));
        }
        return response()->json([
            'success' => true
          ]);

    }
    
}
