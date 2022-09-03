<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'image' => 'sometimes',
            'name' => 'required|string|max:255',
            'email' =>'required|string|email|max:255'
        ];
    }
}
