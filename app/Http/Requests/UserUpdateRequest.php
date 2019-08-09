<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
          'name' => 'required',
          'email' => ['required', Rule::unique('users')->ignore($this->route('user')->id)],
        ];

        if ($this->filled('password'))
        {
            $rules['password'] = ['confirmed', 'min:6'];
        }

        return $rules;
    }
}
