<?php

use App\Http\Controllers\Api\Order\GetOrders;
use App\Http\Controllers\Api\Order\GetOrdersWithStock;
use App\Http\Controllers\Api\Product\GetProductWithStock;
use App\Http\Middleware\ReturnJsonResponse;
use Illuminate\Support\Facades\Route;

Route::middleware(ReturnJsonResponse::class)->group(function () {
    Route::prefix("order")->group(function () {
        Route::get("orders", GetOrders::class)->name("get-orders");
    });

    Route::prefix("product")->group(function () {
        Route::get("products-with-stock", GetProductWithStock::class)->name("get-product-with-stock");

    });
});

