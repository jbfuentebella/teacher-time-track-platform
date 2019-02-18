<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountChangePasswordRequest extends FormRequest
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
            'password' => ['required', 'confirmed', 'min:8', 'same:password']
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'New Password is required.',
            'password.confirmed' => 'New Password is not similar to Confirm Password'
        ];
    }
}
