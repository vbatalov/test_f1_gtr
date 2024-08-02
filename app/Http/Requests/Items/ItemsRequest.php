<?php

namespace App\Http\Requests\Items;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemsRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "products" => [
                "array", "required",
            ],
//            "products.*.id" => [
//                "required",
//                Rule::exists("products", "id"),
//                Rule::exists("stocks", "product_id"),
//            ],
//            "products.*.count" => "required|integer|min:1",
        ];
    }
}
