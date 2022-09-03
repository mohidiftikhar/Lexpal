<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialRequest extends BaseApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'driver' => 'required',
            'email' => 'required',
            'product_type' => 'required|in:DEFAULT,web,android,ios,chrome'
        ];
    }
}
