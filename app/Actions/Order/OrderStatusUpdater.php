<?php

namespace App\Actions\Order;

use App\DTOs\OrderDTO;
use App\Enums\StatusEnum;
use App\Http\Requests\Order\UpdateOrderStatusRequest;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

readonly class OrderStatusUpdater
{
    public function __construct(private UpdateOrderStatusRequest $request)
    {
    }

    public function complete()
    {
        $order = Order::findOrFail($this->request->validated()['id']);

        DB::transaction(function () use ($order) {
            if ($order->status == StatusEnum::ACTIVE) {
                $order->update([
                    "completed_at" => Carbon::now()
                ]);
            }

            $order->update(
                [
                    "status" => StatusEnum::COMPLETED
                ]);
        });


        return $order;
    }

    public function cancel()
    {
        $order = Order::findOrFail($this->request->validated()['id']);

        if (($order->status != StatusEnum::ACTIVE)) {
            throw ValidationException::withMessages([
                "Отменить можно только активный заказ"
            ]);
        }
        OrderStock::return_stock($order);

        $order->update([
            "status" => StatusEnum::CANCELED
        ]);

        return $order;
    }

    public function resume(OrderDTO $orderDTO): Order
    {
        $order = Order::findOrFail($orderDTO->id);

        if ($order->status != StatusEnum::CANCELED) {
            throw ValidationException::withMessages([
                "Вернуть заказ в работу можно только в статусе отменен."
            ]);
        }

        $products = [];
        foreach ($order->items->toArray() as $item) {
            $products [] = [
                "id" => $item['product_id'],
                "count" => $item['count']
            ];
        }

        OrderStock::check_stock(warehouse_id: $order->warehouse_id, products: $products);
        OrderStock::write_off(warehouse_id: $order->warehouse_id, products: $products);

        $order->update([
            "status" => StatusEnum::ACTIVE
        ]);

        return $order;
    }
}
