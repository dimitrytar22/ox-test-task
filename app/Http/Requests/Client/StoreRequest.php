<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'full_name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:clients',
            'phone' => 'required|regex:/\+[0-9]{10}/|unique:clients',
            'address' => 'required|max:255',
            'date_of_birth' => 'required|date'
        ];
    }
    public function messages()
    {
        return [
            'full_name.required' => 'You must enter full name',
            'full_name.min' => 'Min length 3 symbols',
            'full_name.max' => 'Max length 255 symbols',
            'email.required' => 'You must enter email',
            'email.unique' => 'Email already exists',
            'email.email' => 'Not valid email',
            'phone.required' => "You must enter phone",
            'phone.regex' => 'Not valid phone',
            'phone.unique' => 'Phone already exists',
            'address.required' => 'You must enter address',
            'address.max' => "Max length 255 symbols",
            'date_of_birth.required' => "Date of birth required",
            'date_of_birth.date' => "Invalid format"
        ];
    }
}
