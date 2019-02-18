<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'min:2'],
            'last_name' => ['required', 'min:2'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First Name is required.',
            'first_name.min' => 'First Name must be at least 2 characters.',
            'last_name.required' => 'Last Name is required.',
            'last_name.min' => 'Last Name must be at least 2 characters.',
        ];
    }
}
