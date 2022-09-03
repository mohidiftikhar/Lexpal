<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name'                 => 'required|unique:pages,name',
            'heading'              => 'required',
            'content'              => 'required',
            'header'               => 'required',
            'footer'               => 'required',
            'bg'                   => 'required'
        ];
    }
}
