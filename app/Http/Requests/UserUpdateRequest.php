<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules($request)
    {
        $id = $request->id;
        $rules = [
          'name'  => 'required',
          'email' => 'required|email|unique:users,email,'.$id,

        ];

        if ($this->filled('password'))
        {
            $rules['password'] = ['confirmed', 'min:6'];
        }
        return $rules;
    }
}
