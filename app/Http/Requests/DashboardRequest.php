<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DashboardRequest extends FormRequest
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
            'action' => 'required|in:1,2,3,4', 
            'date' => 'required|date_format:Y-m-d',
            'time'  => 'required|date_format:H:i:s',
            'status' => 'required|in:ontime,late',
        ];

    }
}
