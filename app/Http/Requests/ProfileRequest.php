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
            'firstname' => 'max:255|regex:/^[a-zA-Z\s]+$/',
            'lastname' => 'max:255|regex:/^[a-zA-Z\s]+$/',
            'address' => 'max:255',
            'birthday' => 'date',
            'contact_num' => 'max:255|regex:/^[0-9]+$/',
            'position' => 'max:255',
            'civil_status' => 'required|in:single,married,widowed,divorced',
        ];
    }
}
