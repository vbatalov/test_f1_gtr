<?php

namespace App\Actions\Items;

use App\Http\Requests\Items\ItemsRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class ItemsUpdater
{
    public function __construct(private ItemsRequest $request)
    {
    }

    public function update(Order $order): void
    {

        DB::transaction(function () use ($order) {
            $order->items()->delete();
            foreach ($this->request->validated() as $product) {
                foreach ($product as $item) {
                    OrderItem::create([
                        "order_id" => $order->id,
                        "product_id" => $item['id'],
                        "count" => $item['count']
                    ]);
                }
            }
        });
    }

}
