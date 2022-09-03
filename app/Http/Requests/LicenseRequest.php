<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LicenseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        //dd($this->request->all());
        $todayDate = date('y-m-d');
        return [
            'social_type'      =>  'required|in:DEFAULT,google,azure',
            'product_id'            =>  'required',
            'domain_name'            =>  'required',
            'contract_id'            =>  'sometimes',
            'client_name'            =>  'required',
            'expiry_date'            =>  'required|after_or_equal:'.$todayDate,
            'status'            =>  'required',
        ];
    }
}
