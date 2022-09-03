<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppLinkId extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'id'               =>  'exist:app_links , id'
        ];
    }
}
