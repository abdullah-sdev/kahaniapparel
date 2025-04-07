<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->can('create', Product::class);
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
            'name' => 'required|string|max:255|unique:products,name',
            'actual_price' => 'required|numeric|min:0',
            'discounted_price' => 'required|numeric|min:0|lt:actual_price',
            'description' => 'required|string',
            'thumbnail_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'thumbnail_image1' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',

            'color_id' => 'required|array|min:1',
            'color_id.*' => 'exists:colors,id',

            'size_id' => 'required|array|min:1',
            'size_id.*' => 'exists:sizes,id',

            'category_id' => 'required|array|min:1',
            'category_id.*' => 'exists:categories,id',
        ];
    }
}
