<?php

namespace App\Http\Controllers\Api\Order;

use App\Actions\Order\OrderStatusUpdater;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\UpdateOrderStatusRequest;
use App\Http\Resources\Order\OrderResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CancelOrder extends Controller
{
    public function __invoke(UpdateOrderStatusRequest $request, OrderStatusUpdater $orderStatusUpdater)
    {
        $order = $orderStatusUpdater->cancel();

        return new JsonResponse(OrderResource::make($order), Response::HTTP_OK);
    }
}
