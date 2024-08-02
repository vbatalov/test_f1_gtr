<?php

namespace App\Http\Controllers\Api\Order;

use App\Actions\Order\OrderStatusUpdater;
use App\DTOs\OrderDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\ResumeOrderRequest;
use App\Http\Resources\Order\OrderResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResumeOrder extends Controller
{
    public function __invoke(OrderDTO $orderDTO, OrderStatusUpdater $orderStatusUpdater)
    {
        $order = $orderStatusUpdater->resume($orderDTO);
        return new JsonResponse(OrderResource::make($order), Response::HTTP_OK);
    }
}
