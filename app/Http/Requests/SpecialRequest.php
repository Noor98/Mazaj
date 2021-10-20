<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecialRequest extends FormRequest
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
            'address'=> 'required',
            'mobile'=> 'required',
            'delivery_branch'=> 'required',
            'delivery_date' => 'required',
            'delivery_address'=> 'required',
            'delivery_time'=> 'required',
            'size'=> 'required',
            'count' => 'required',



        ];
    }
}
