<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Models\Stock;
use Illuminate\Validation\ValidationException;

readonly class OrderStock
{
    public static function check_stock(int $warehouse_id, array $products): void
    {
        foreach ($products as $product) {
            $stock = Stock::where([
                "product_id" => $product['id'],
                "warehouse_id" => $warehouse_id
            ])->first();

//            dump($products);
            if (is_null($stock) or ($stock->stock < $product['count'])) {
                throw ValidationException::withMessages([
                    "Товар [ID: {$product['id']}] отсутствует на складе [ID: $warehouse_id]"
                ]);
            }
        }
    }

    public static function write_off(int $warehouse_id, array $products): void
    {
        foreach ($products as $product) {
            $stock = Stock::where([
                "product_id" => $product['id'],
                "warehouse_id" => $warehouse_id
            ])->firstOrFail();


            $stock_after_create = $stock->stock - $product['count'];
            $stock->update([
                "stock" => $stock_after_create
            ]);
        }
    }

    public static function return_stock(Order $order): void
    {
        $warehouse_id = $order->warehouse_id;

        foreach ($order->items as $item) {
            $stock = Stock::where([
                "warehouse_id" => $warehouse_id,
                "product_id" => $item['product_id'],
            ])->firstOrFail();

            $stock->update([
                "stock" => $stock->stock + $item['count']
            ]);
        }
    }
}
