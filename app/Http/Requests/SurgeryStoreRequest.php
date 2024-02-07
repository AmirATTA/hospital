<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SurgeryStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'document_number' => [
                'required',
                Rule::unique('surgeries')->ignore($this->route('surgery'))
            ],
            'patient_name' => 'required',
            'patient_national_code' => 'required',
            'insurance' => 'nullable',
            'description' => 'nullable',
            'surgeried_at' => 'required',
            'released_at' => 'required',
        ];
    }
}
