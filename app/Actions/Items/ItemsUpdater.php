<?php

namespace App\Actions\Items;

use App\Http\Requests\Items\ItemsRequest;
use App\Models\Order;

class ItemsUpdater
{
    public function __construct(private ItemsRequest $request)
    {
    }

    public function update(Order $order)
    {
        return $order->items()->sync([
            $this->request->all()
        ]);
    }

}
