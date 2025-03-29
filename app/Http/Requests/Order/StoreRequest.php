<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

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
            'items' => 'required|json',
            'status_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'items.required' => 'Items are required',
            'status_id.required' => "Status is required",
            'status_id.integer' => "Status id must be int"
        ];
    }
}
