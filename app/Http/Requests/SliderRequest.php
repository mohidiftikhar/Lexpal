<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class SliderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'image'              =>  'required|mimes:jpeg,jpg,png|dimensions:max_width=460,max_height=630|dimensions:min_width=460,min_height=630',
            'heading'            =>  'required',
            'description'        =>  'required',
            'app_link_id'        =>  'sometimes|array',
            'app_link_id.*'      =>  'exists:app_links,id',
        ];
    }
}
