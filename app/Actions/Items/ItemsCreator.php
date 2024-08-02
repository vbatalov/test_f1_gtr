<?php

namespace App\Actions\Items;

use App\Actions\Order\OrderStock;
use App\DTOs\OrderDTO;
use App\DTOs\ProductDTO;
use App\Models\Order;
use App\Models\OrderItem;

readonly class ItemsCreator
{
    public function __construct()
    {
    }

    public function store(OrderDTO $orderDTO, ProductDTO $productDTO): void
    {
        $order = Order::findOrFail($orderDTO->id);

        OrderStock::check_stock(warehouse_id: $order->warehouse_id, products: $productDTO->products);
        OrderStock::write_off(warehouse_id: $order->warehouse_id, products: $productDTO->products);

        foreach ($productDTO->products as $product) {
            OrderItem::create([
                "order_id" => $order->id,
                "product_id" => $product['id'],
                "count" => $product['count']
            ]);
        }
    }


}
