<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class GetOrders extends Controller
{
    public function __invoke(Request $request)
    {
        return OrderResource::collection(Order::paginate());
    }
}
