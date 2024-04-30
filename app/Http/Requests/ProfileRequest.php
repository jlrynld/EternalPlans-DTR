<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ProfileRequest extends FormRequest
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
            'address' => '|max:255',
            'firstname' => 'max:255|regex:/^[a-zA-Z\s]+$/',
            'lastname' => 'max:255|regex:/^[a-zA-Z\s]+$/',
            'birthday' => '',
            'email' => 'email|max:255|unique:users',
            'position' => '|max:255|regex:/^[a-zA-Z\s]+$/',
            'civil_status' => '|in:single, married, divorced, widowed, seperated',
        ];
    }
}