<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseApiRequest extends FormRequest
{
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        foreach ($validator->messages()->getMessages() as $key => $message) {
            $messages[] = $message[0];
        }
        $response = response()->json([
            'status'       =>  false,
            'messages'      =>  $messages,
        ],422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
