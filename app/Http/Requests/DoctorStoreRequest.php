<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:doctors,name',
            'speciality_id' => 'required',
            'mobile' => 'required|unique:doctors,mobile',
            'doctorRoles' => 'required',
            'password' => 'required|confirmed',
        ];
    }
}
