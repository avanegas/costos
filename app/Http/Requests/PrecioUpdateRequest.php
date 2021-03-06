<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrecioUpdateRequest extends FormRequest
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
            'user_id'           => 'required',
            'grupo_precio_id'   => 'required',
            'name'              => 'required',
            'unidad'            => 'required',
            'detalle'           => 'required',
            'directo'           => 'required|numeric',
            'indirecto'         => 'required|numeric',
        ];
    }
}
