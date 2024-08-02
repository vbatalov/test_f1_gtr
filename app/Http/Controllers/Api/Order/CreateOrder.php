<?php

namespace App\Http\Controllers\Api\Order;

use App\Actions\Order\OrderCreator;
use App\DTOs\OrderDTO;
use App\DTOs\ProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\Item\ItemResource;
use App\Http\Resources\Order\OrderResource;
use Symfony\Component\HttpFoundation\Response;

class CreateOrder extends Controller
{
    public function __invoke(OrderDTO $orderDTO, ProductDTO $productDTO, OrderCreator $orderCreator)
    {
        $order = $orderCreator->store($orderDTO, $productDTO);

        return response()->json([
            "order" => OrderResource::make($order),
            "items" => ItemResource::collection($order->items),
        ], Response::HTTP_CREATED);
    }
}
