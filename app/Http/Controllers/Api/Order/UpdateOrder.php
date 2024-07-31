<?php

namespace App\Http\Controllers\Api\Order;

use App\Actions\Items\ItemsUpdater;
use App\Actions\Order\OrderUpdater;
use App\Http\Controllers\Controller;
use App\Http\Requests\Items\ItemsRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Models\Order;

class UpdateOrder extends Controller
{
    public function __invoke(UpdateOrderRequest $updateOrderRequest, ItemsRequest $itemsRequest, OrderUpdater $orderUpdater, ItemsUpdater $itemsUpdater)
    {
        dd(Order::find(26)->items);
        $order = Order::find($updateOrderRequest->get("id"));

        return $itemsUpdater->update($order);
    }
}
