<?php

namespace App\Actions\Items;


use App\Actions\Order\OrderStock;
use App\DTOs\OrderDTO;
use App\DTOs\ProductDTO;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class ItemsUpdater
{
    public static function update_items(OrderDTO $orderDTO, ProductDTO $productDTO): void
    {
        DB::transaction(function () use ($orderDTO, $productDTO) {
            $order = Order::findOrFail($orderDTO->id);

            OrderStock::check_stock(warehouse_id: $order->warehouse_id, products: $productDTO->products);
            OrderStock::write_off(warehouse_id: $order->warehouse_id,products: $productDTO->products);

            $order->items()->delete();
            foreach ($productDTO->products as $product) {
                OrderItem::create([
                    "order_id" => $order->id,
                    "product_id" => $product['id'],
                    "count" => $product['count']
                ]);

            }
        });
    }

}
