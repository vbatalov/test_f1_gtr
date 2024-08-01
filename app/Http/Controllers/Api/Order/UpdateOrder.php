<?php

namespace App\Http\Controllers\Api\Order;

use App\Actions\Items\ItemsUpdater;
use App\Actions\Order\OrderUpdater;
use App\Http\Controllers\Controller;
use App\Http\Requests\Items\ItemsRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateOrder extends Controller
{
    public function __invoke(UpdateOrderRequest $updateOrderRequest, ItemsRequest $itemsRequest, OrderUpdater $orderUpdater, ItemsUpdater $itemsUpdater)
    {
        // init order
        $order = Order::find($updateOrderRequest->get("id"));

        // update order_items
        $itemsUpdater->update($order);

        // update order
        $orderUpdater->update();

        return new JsonResponse([], Response::HTTP_OK);
    }
}
