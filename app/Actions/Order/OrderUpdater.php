<?php

namespace App\Actions\Order;

use App\Http\Requests\Order\UpdateOrderRequest;
use App\Models\Order;

readonly class OrderUpdater
{
    public function __construct(private UpdateOrderRequest $request)
    {
    }

    public function update(): void
    {
        Order::find($this->request->validated(['id']))
            ->update([
                $this->request->validated()
            ]);
    }
}
