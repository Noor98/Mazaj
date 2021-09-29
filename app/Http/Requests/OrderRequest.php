<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            //'user_id'    => 'required',
            'order_date' => 'required',
            'item_id_arr'=> 'required',
            'qty_arr'=> 'required',
            'desc_arr'=> 'required',

        ];
    }
}
