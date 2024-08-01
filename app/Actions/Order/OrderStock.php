<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

readonly class OrderStock
{
    public static function check_stock(int $warehouse_id, array $products): void
    {
        foreach ($products as $product) {
            $stock = Stock::where([
                "product_id" => $product['id'],
                "warehouse_id" => $warehouse_id
            ])->firstOrFail();

            if ($stock->stock < $product['count']) {
                throw ValidationException::withMessages([
                    "Количество товара [ID: {$product['id']}] больше, чем доступное количество ($stock->stock)"
                ]);
            }
        }
    }

    public static function write_off(int $warehouse_id, array $products)
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

    public static function return_stock(Order $order)
    {
        $items = $order->items;

        foreach ($items as $item) {
            $order->join("");

            dd($order);
        }
    }
}
