<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductValidator extends FormRequest
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
            "name" => "sometimes|required|string|max:255",
            "description" => "nullable|string",
            "price" => "sometimes|required|numeric",
            "sku" => "sometimes|required|string|max:30|unique:products,sku",
            "category_id" => "sometimes|required|exists:categories,id"
        ];
    }
}
