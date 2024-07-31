<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductWithStockResource;
use App\Models\Product;

class GetProductWithStock extends Controller
{
    public function __invoke()
    {
        return ProductWithStockResource::collection(Product::paginate(10));
    }
}
