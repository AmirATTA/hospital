<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'mobile' => [
                'required',
                'regex:/[0]{1}[0-9]{10}/',
                Rule::unique('users')->ignore($this->route('user', Auth::id()))
            ],
            'email' => 'required|email',
            'password' => 'nullable|confirmed',
        ];
    }
        
    public function messages()
    {
        return [
            'password.regex' => 'کلمه عبور باید حتما حداقل دارای یک حروف کوچک و یک حروف بزرگ و یک عدد باشد',
            'mobile.regex' => 'فرمت شماره شما صحیح نیست',
        ];
    }
}
