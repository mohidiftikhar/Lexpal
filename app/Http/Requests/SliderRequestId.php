<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequestId extends FormRequest
{
    public $id;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'exist:sliders , id'
        ];
    }
}
