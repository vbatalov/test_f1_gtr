<?php

namespace App\Actions\Items;

use App\Http\Requests\Items\ItemsRequest;
use App\Models\Order;
use App\Models\OrderItem;

class ItemsCreator
{
    public function __construct(private ItemsRequest $request)
    {
    }

    public function store(Order $order)
    {
        foreach ($this->request->post("products") as $product) {
            OrderItem::create([
                "order_id" => $order->id,
                "product_id" => $product['id'],
                "count" => $product['count']
            ]);
        }

        return OrderItem::whereOrderId($order->id)->get();
    }
}
