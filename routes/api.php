<?php

use App\Http\Controllers\Api\Order\CancelOrder;
use App\Http\Controllers\Api\Order\CompleteOrder;
use App\Http\Controllers\Api\Order\CreateOrder;
use App\Http\Controllers\Api\Order\FilterOrder;
use App\Http\Controllers\Api\Order\GetOrders;
use App\Http\Controllers\Api\Order\UpdateOrder;
use App\Http\Controllers\Api\Product\GetProductWithStock;
use App\Http\Middleware\ReturnJsonResponse;
use Illuminate\Support\Facades\Route;

Route::middleware(ReturnJsonResponse::class)->group(function () {
    Route::prefix("order")->group(function () {
        Route::get("orders", GetOrders::class)->name("get-orders");
        Route::post("create", CreateOrder::class)->name("create-order");
        Route::put("update", UpdateOrder::class)->name("update-order");
        Route::get("filter", FilterOrder::class)->name("filter-order");
        Route::patch("complete", CompleteOrder::class)->name("complete-order");
        Route::patch("cancel", CancelOrder::class)->name("cancel-order");
    });

    Route::prefix("product")->group(function () {
        Route::get("stock", GetProductWithStock::class)->name("product-stock");
    });
});

