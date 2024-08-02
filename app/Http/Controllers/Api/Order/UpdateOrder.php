<?php

namespace App\Http\Controllers\Api\Order;

use App\Actions\Items\ItemsUpdater;
use App\Actions\Order\OrderUpdater;
use App\DTOs\OrderDTO;
use App\DTOs\ProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\Item\ItemResource;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Product\ProductResource;
use Symfony\Component\HttpFoundation\Response;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class UpdateOrder extends Controller
{
    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public function __invoke(UpdateOrderRequest $updateOrderRequest, ProductDTO $productDTO, OrderUpdater $orderUpdater, ItemsUpdater $itemsUpdater)
    {
        $orderDTO = OrderDTO::fromRequest($updateOrderRequest);

        $order = $orderUpdater->update($orderDTO, $productDTO);

        return \response()->json([
            OrderResource::make($order),
            ItemResource::collection($order->items)
        ], Response::HTTP_OK);
    }
}
