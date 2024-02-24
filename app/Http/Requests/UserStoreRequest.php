<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'mobile' => 'required|unique:users,mobile|regex:/[0]{1}[0-9]{10}/',
            'email' => 'nullable',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]+$/',
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
