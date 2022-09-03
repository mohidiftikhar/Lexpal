<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'app_link_id[]'      =>  'sometimes',
            'slider_id'            =>  'required',
        ];
    }
}
