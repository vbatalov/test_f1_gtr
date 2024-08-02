<?php

namespace App\Actions\Order;

use App\Actions\Items\ItemsUpdater;
use App\DTOs\OrderDTO;
use App\DTOs\ProductDTO;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

readonly class OrderUpdater
{
    public function update(OrderDTO $orderDTO, ProductDTO $productDTO): Order
    {
        return DB::transaction(function () use ($orderDTO, $productDTO) {
            $order = Order::find($orderDTO->id);
            $order->update([
                "customer" => $orderDTO->customer,
            ]);

            ItemsUpdater::update_items($orderDTO, $productDTO);

            return $order;
        });

    }
}
