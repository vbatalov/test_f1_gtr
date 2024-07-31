<?php

namespace App\Http\Controllers\Api\Order;

use App\Actions\Items\ItemsCreator;
use App\Actions\Order\OrderCreator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Items\ItemsRequest;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Resources\Item\ItemResource;
use App\Http\Resources\Order\OrderResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateOrder extends Controller
{
    public function __invoke(CreateOrderRequest $orderRequest, ItemsRequest $itemsRequest, OrderCreator $orderCreator, ItemsCreator $itemsCreator)
    {
        $order = $orderCreator->store();
        $items = $itemsCreator->store($order);
        return new JsonResponse([
            "order" => OrderResource::make($order),
            "items" => ItemResource::collection($items),
        ], Response::HTTP_CREATED);
    }
}
