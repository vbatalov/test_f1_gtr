<?php

namespace App\Actions\Items;

use App\Actions\Order\OrderStock;
use App\Http\Requests\Items\ItemsRequest;
use App\Models\Order;
use App\Models\OrderItem;

readonly class ItemsCreator
{
    public function __construct(private ItemsRequest $request)
    {
    }

    public function store(Order $order)
    {
        $this->prepend();

        foreach ($this->request->post("products") as $product) {
            OrderItem::create([
                "order_id" => $order->id,
                "product_id" => $product['id'],
                "count" => $product['count']
            ]);
        }
    }

    private function prepend(): void
    {
        $warehouse_id = $this->request->get("warehouse_id");
        $products = $this->request->validated()['products'];


        OrderStock::check_stock($warehouse_id, $products);
        OrderStock::write_off($warehouse_id, $products);
    }
}
