<?php

namespace App\Actions\Order;

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

        DB::transaction(function () use ($order) {
            if ($order->status == StatusEnum::COMPLETED) {
                throw ValidationException::withMessages([
                    "Завершенный заказ нельзя отменить"
                ]);
            }
            OrderStock::return_stock($order);
        });


        return $order->update([
            "status" => StatusEnum::CANCELED
        ]);

    }
}
