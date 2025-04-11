<?php

namespace App\Http\Requests\Kahani;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return Auth::check();
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
            //
            'product_id' => 'required|exists:products,id',
            'selectedSize' => 'required|exists:sizes,name',
            'selectedColor' => 'required|exists:colors,name',
            'quantity' => 'required|integer|min:1',
            'action' => 'required|in:Add to Cart,Buy Now',
        ];
    }
}
