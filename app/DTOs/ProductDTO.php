<?php

namespace App\DTOs;

use Illuminate\Validation\Rule;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class ProductDTO extends ValidatedDTO
{

    public array $products;

    protected function rules(): array
    {
        return [
            "products" => [
                "array", "required",
            ],
            "products.*.id" => [
                "required",
                Rule::exists("products", "id"),
//                Rule::exists("stocks", "product_id"),
            ],
            "products.*.count" => "required|integer|min:1",
        ];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }
}
