<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name'                  =>  'required|unique:pages,name,'.$this->id,
            'heading'             =>  'required',
            'content'             =>  'required',
            'header'               => 'required',
            'footer'               => 'required',
            'bg'                    =>    'required'
        ];
    }
}
