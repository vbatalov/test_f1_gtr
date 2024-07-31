<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Stock\StockResource;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductWithStockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "product" => ProductResource::make(Product::find($this->id)),
            "stocks" => StockResource::collection(Product::find($this->id)->stocks)
        ];
    }
}
