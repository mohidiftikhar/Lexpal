<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name'                =>  'required',
            'price'               =>  'required|numeric|min:0',
            'currency'            =>  'required',
            'plan_duration'       =>  'required|numeric|min:0',
            'duration_period'     =>  'required',
            'content'             =>  'required',
            'status'              =>  'required',
        ];
    }
}
