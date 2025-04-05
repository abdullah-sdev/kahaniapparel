<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            // Address selection (either existing or new)
            'address_id' => 'required_without:new_address|exists:addresses,id,user_id,'.Auth::user()->id,

            // New address fields (only required if address_id not provided)
            // 'new_address' => 'required_without:address_id|array',
            // 'new_address.full_name' => 'required_with:new_address|string|max:255',
            // 'new_address.phone' => 'required_with:new_address|string|max:20|regex:/^[\d\s\+\-\(\)]{10,20}$/',
            // 'new_address.address_line_1' => 'required_with:new_address|string|max:255',
            // 'new_address.address_line_2' => 'nullable|string|max:255',
            // 'new_address.city' => 'required_with:new_address|string|max:255',
            // 'new_address.state' => 'required_with:new_address|string|max:255',
            // 'new_address.postal_code' => 'required_with:new_address|string|max:20|regex:/^[a-zA-Z0-9\s\-]+$/',
            // 'new_address.country' => 'required_with:new_address|string|max:255',
            // 'new_address.is_default' => 'nullable|boolean',

            // Payment and shipping
            'payment_type' => 'required|in:cash,credit_card',
            'cargo_company_id' => 'required|exists:cargo_companies,id',
            'discount_id' => 'nullable|exists:discounts,id',

            // Order items
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1|max:100',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.attributes' => 'nullable|array',
        ];
    }

    // public function messages()
    // {
    //     [
    //         // Address selection messages
    //         'address_id.required_without' => 'Please select an existing address or provide a new one',
    //         'address_id.exists' => 'The selected address is invalid',

    //         // New address messages
    //         'new_address.required_without' => 'Please provide a new address or select an existing one',
    //         'new_address.array' => 'Address information must be provided as an array',

    //         'new_address.full_name.required_with' => 'Full name is required for new address',
    //         'new_address.phone.required_with' => 'Phone number is required for new address',
    //         'new_address.address_line_1.required_with' => 'Address line 1 is required for new address',
    //         'new_address.city.required_with' => 'City is required for new address',
    //         'new_address.state.required_with' => 'State/Province is required for new address',
    //         'new_address.postal_code.required_with' => 'Postal code is required for new address',
    //         'new_address.country.required_with' => 'Country is required for new address',

    //         // Payment and shipping messages
    //         'payment_type.required' => 'Please select a payment method',
    //         'payment_type.in' => 'Invalid payment method selected',

    //         'cargo_company_id.required' => 'Please select a shipping company',
    //         'cargo_company_id.exists' => 'The selected shipping company is invalid',

    //         'discount_id.exists' => 'The selected discount is invalid',

    //         // Order items messages
    //         'items.required' => 'Please add at least one item to your order',
    //         'items.min' => 'Please add at least one item to your order',

    //         'items.*.product_id.required' => 'Each item must have a product selected',
    //         'items.*.product_id.exists' => 'One or more selected products are invalid',

    //         'items.*.quantity.required' => 'Each item must have a quantity specified',
    //         'items.*.quantity.integer' => 'Quantity must be a whole number',
    //         'items.*.quantity.min' => 'Minimum quantity is 1',
    //         'items.*.quantity.max' => 'Maximum quantity per item is 100',

    //         'items.*.price.required' => 'Each item must have a price',
    //         'items.*.price.numeric' => 'Price must be a number',
    //         'items.*.price.min' => 'Price cannot be negative',

    //         'items.*.attributes.array' => 'Product attributes must be provided as an array',
    //     ];
    // }
}
