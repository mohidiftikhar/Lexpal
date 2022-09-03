<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{
    public $email;

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'email'               =>  'required|email'
        ];
    }
}
