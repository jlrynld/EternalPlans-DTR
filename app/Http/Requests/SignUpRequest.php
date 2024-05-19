<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type' => 'required|in:Employee,Manager',
            'firstname' => 'required|max:255|regex:/^[a-zA-Z\s]+$/',
            'lastname' => 'required|max:255|regex:/^[a-zA-Z\s]+$/',
            'middlename' => 'max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
            'password_confirmation' => 'required|min:8|max:255',
        ];
    }
}
