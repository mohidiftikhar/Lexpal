<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name'             =>  'required',
            'type'             =>  'required|in:DEFAULT,web,android,ios,chrome',
        ];
    }
}
