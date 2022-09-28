<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'name' => 'nullable',
            'email' => 'email|unique:users',
            'password' => 'confirmed',
            'last_name' => 'nullable',
            'company_id' => 'exists:companies,id',
            'phone' => 'min:10|max:10',
        ];
    }
}
