<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class DoctorUpdateRequest extends FormRequest
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
            'speciality_id' => 'required',
            'mobile' => [
                'required',
                Rule::unique('doctors')->ignore($this->route('doctor'))
            ],
            'doctorRoles' => 'required',
            'password' => 'nullable|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]+$/',
        ];
    }
    
    public function messages()
    {
        return [
            'password.regex' => 'کلمه عبور باید حتما حداقل دارای یک حروف کوچک و یک حروف بزرگ و یک عدد باشد',
        ];
    }
}
