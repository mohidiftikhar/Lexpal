<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppLinksRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'icon'               =>     'required|mimes:jpeg,jpg,png|dimensions:max_width=42,max_height=42|dimensions:min_width=42,min_height=42',
            'short_heading'            =>  'required|Max:10',
            'heading'            =>  'required|Max:10',
            'url'            =>  'required|url',
        ];
    }
}
