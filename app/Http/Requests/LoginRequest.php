<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mobile' => 'required|regex:/[0]{1}[0-9]{10}/',
            'password' => 'required',
        ];
    }
      
    public function messages()
    {
        return [
            'mobile.regex' => 'فرمت شماره شما صحیح نیست',
        ];
    }
}
