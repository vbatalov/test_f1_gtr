<?php

namespace App\Actions\Order;

use App\Actions\Items\ItemsCreator;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Models\Order;


readonly class OrderCreator
{
    public function __construct(private readonly CreateOrderRequest $request, private readonly ItemsCreator $itemsCreator)
    {
    }

    public function store()
    {
        $order = Order::create($this->request->all());
        $this->itemsCreator->store($order);

        return $order->refresh();
    }


}
