<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class RegisterStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'other_name' => 'sometimes|string',
            'guardian_id' => 'required|integer',
            'class_category_id' => 'sometimes|integer',
            'class_id' => 'required|integer',
            'wing' => 'sometimes|string',
            'session_id' => 'required|integer',
            'admission_no' => 'required|string',
            'address' => 'required|max:200',
            'state_id' => 'required|integer',
            'lga_id' => 'required|integer',
            'category' => 'required_if:class_category_id,4',
            'gender' => 'required'
        ];

    }

    public function passedValidation()
    {
        $this->merge([
            'password' => Hash::make($this->admission_no),
        ]);
    }
}
