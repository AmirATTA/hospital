<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SurgeryUpdateRequest extends FormRequest
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
            'doctorsInputRequired' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value[0] == null) {
                        $fail("لطفا براي نقش هاي مورد نطر یک دكتر انتخاب كنيد");
                    }
                },
            ],
            'doctorsInput' => 'nullable',  
            'surgeried_at' => 'required|date|after_or_equal:today',
            'released_at' => 'required|after_or_equal:surgeried_at',
        ];
    }
}
