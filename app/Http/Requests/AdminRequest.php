<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'image'      => 'sometimes',
            'email'      =>  'required|email|exists:users,email',
            'password'   =>  'required|min:6',
        ];
    }
}
