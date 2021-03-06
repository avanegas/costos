<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransporteStoreRequest extends FormRequest
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
            'zona_id'   => 'required',
            'name'      => 'required',
            'unidad'    => 'required',
            'tipo'      => 'required',
            'tarifa'    => 'required|numeric',
        ];
    }
}
