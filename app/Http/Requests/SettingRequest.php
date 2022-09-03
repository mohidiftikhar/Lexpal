<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'address'             =>  'sometimes',
            'phone'            =>  'sometimes',
            'email'            =>  'sometimes',
            'fb_url'            =>  'sometimes',
            'instagram_url'            =>  'sometimes',
            'twitter_url'            =>  'sometimes',
            'linkedin_url'            =>  'sometimes',
            'tik_tok_url'            =>  'sometimes',
            'header_heading'            =>  'sometimes',
            'header_description'            =>  'sometimes|max:150',
            'login_heading'            =>  'sometimes',
            'login_description'            =>  'sometimes|max:350',
            'get_in_touch_description'            =>  'sometimes|max:150',
            'contact_us_description'            =>  'sometimes|max:150',
            'policy'            =>  'sometimes',
            'policy_heading'            =>  'sometimes',
            'policy_description'            =>  'sometimes|max:150',
        ];
    }
}
