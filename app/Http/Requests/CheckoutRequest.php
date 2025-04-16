<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
        $rules = [
            'address_id' => 'nullable|exists:addresses,id',
            'new_address.use_address' => 'nullable|boolean',
        ];

        $useAddress = $this->input('new_address.use_address');
        $addressId = $this->input('address_id');

        if (! $addressId && $useAddress) {
            $rules = array_merge($rules, [
                'new_address.full_name' => 'required|string|max:255',
                'new_address.email' => 'required|email|max:255',
                'new_address.phone' => 'required|string|max:255',
                'new_address.address_line_1' => 'required|string|max:255',
                'new_address.address_line_2' => 'nullable|string|max:255',
                'new_address.city' => 'required|string|max:255',
                'new_address.state' => 'required|string|max:255',
                'new_address.country' => 'required|string|max:255',
                'new_address.postal_code' => 'required|string|max:255',
                'new_address.is_default' => 'nullable|boolean',
            ]);
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'address_id.required' => 'Please select an existing address or enter a new one.',
            'new_address.full_name.required' => 'Full name is required when using a new address.',
            'new_address.email.required' => 'Email is required when using a new address.',
            // Add more friendly messages here as needed...
        ];
    }
}
