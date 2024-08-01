<?php

namespace App\Http\Controllers\Api\Order;

use App\Actions\Order\OrderFiltered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\FilterOrderRequest;
use App\Http\Resources\Order\OrderResource;

class FilterOrder extends Controller
{
    public function __invoke(FilterOrderRequest $request, OrderFiltered $orderFiltered)
    {
        return OrderResource::collection($orderFiltered->filter());
    }
}
