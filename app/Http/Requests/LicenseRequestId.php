<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LicenseRequestId extends FormRequest
{
    /**
     * @var mixed
     */
    public $id;

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'id'               =>  'exist:licenses , id'
        ];
    }
}
