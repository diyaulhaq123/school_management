<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadStudentRequest extends FormRequest
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
            'session_id' => 'required|integer',
            'class_id' => 'required|integer',
            'wing' => 'required',
            'student_list' => 'required|file|mimes:xlsx,csv'
        ];
    }
}
