<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterTempAccountRequest extends FormRequest
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
            'username' => ['required', 'min:5', 'unique:accounts'],
            'email' => ['required', 'email', 'unique:accounts'],
            'password' => ['required', 'confirmed', 'min:8', 'same:password']
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First Name is required.',
            'first_name.min' => 'First Name must be at least 2 characters.',
            'last_name.required' => 'Last Name is required.',
            'last_name.min' => 'Last Name must be at least 2 characters.',
            'username.required' => 'Username is required.',
            'username.min' => 'Username must be at least 5 characters.',
            'username.unique' => 'Username has already been taken.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email is invalid.',
            'email.unique' => 'Email has already been taken.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 5 characters.',
            'password.confirmed' => 'Password is not similar to Confirm Password',
        ];
    }
}
