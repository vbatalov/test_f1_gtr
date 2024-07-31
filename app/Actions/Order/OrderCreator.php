<?php

namespace App\Actions\Order;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Models\Order;


class OrderCreator
{
    public function __construct(private CreateOrderRequest $request)
    {
    }

    public function store()
    {
        return Order::create($this->request->all())->refresh();
    }
}
