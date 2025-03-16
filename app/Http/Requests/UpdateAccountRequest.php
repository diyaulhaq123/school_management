<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
        $userId = $this->user() ? $this->user()->id : null;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|exists:users,email,'.  $userId,
            'type' => 'required|string|in:admin,teacher,eo,accountant,principal,guardian',
            'phone' => 'required|digits:11|exists:users,phone,'. $userId,
        ];
    }
}
