<?php

namespace App\Actions\Items;

use App\Http\Requests\Items\ItemsRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class ItemsUpdater
{
    public function __construct(private ItemsRequest $request)
    {
    }

    public function update(Order $order): void
    {
        $this->validate($order);

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

//    private function validate(Order $order)
//    {
//        foreach ($this->request->validated() as $products) {
//            $warehouse_id = $order->warehouse_id;
//
//            foreach ($products as $item) {
//                $stock = Stock::where([
//                    "product_id" => $item['id'],
//                    "warehouse_id" => $warehouse_id
//                ])->firstOrFail();
//
//                $stock_after_update = $stock->stock + $item['count'];
//                dd($stock_after_update);
//            }
//
//
//        }
//    }

}
