<?php

namespace App\Actions\Order;

use App\Actions\Items\ItemsCreator;
use App\DTOs\OrderDTO;
use App\DTOs\ProductDTO;
use App\Models\Order;
use Illuminate\Support\Facades\DB;


readonly class OrderCreator
{
    public function __construct(private ItemsCreator $itemsCreator)
    {
    }

    public function store(OrderDTO $orderDTO, ProductDTO $productDTO): Order
    {
        return DB::transaction(function () use ($orderDTO, $productDTO) {
            $order = new Order();

            $order = $order->create($orderDTO->toArray());

            OrderDTO::fromModel($order->refresh());

            $this->itemsCreator->store(OrderDTO::fromModel($order), $productDTO);
            return $order->refresh();
        });
    }
}
