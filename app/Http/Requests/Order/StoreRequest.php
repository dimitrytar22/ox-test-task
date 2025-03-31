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
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'status_id' => 'required|integer|exists:statuses,id',
            'paid_at' => '',

        ];
    }

    public function messages()
    {
        return [
            'items.required' => 'Items are required',
            'items.array' => "Items must be an array",
            'items.*.item_id.exists' => "Item not found",
            'items.*.item_id.required' => "Item id is required",
            'items.*.quantity.required' => "Quantity is required",
            'items.*.quantity.integer' => 'Quantity must be an integer',
            'items.*.quantity.min' => "Quantity must be greater than 0",
            'status_id.required' => "Status is required",
            'status_id.integer' => "Status id must be int",
            'status_id.exists' => 'Status doesn\'t exist',
        ];
    }
}
