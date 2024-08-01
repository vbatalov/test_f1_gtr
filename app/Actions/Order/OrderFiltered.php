<?php

namespace App\Actions\Order;

use App\Http\Requests\Order\FilterOrderRequest;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;


readonly class OrderFiltered
{
    public function __construct(private FilterOrderRequest $request)
    {
    }

    public function filter()
    {
        $filter = $this->request->validated();

        return Order::where(function (Builder $builder) use ($filter) {
            if (isset($filter['id'])) {
                $builder->where("id", $filter['id']);
            }
        })
            ->where(function (Builder $builder) use ($filter) {
                if (isset($filter['status'])) {
                    $builder->where("status", $filter['status']);
                }
            })
            ->where(function (Builder $builder) use ($filter) {
                if (isset($filter['customer'])) {
                    $builder->where("customer", $filter['customer']);
                }
            })
            ->orderBy("completed_at", $filter['orderBy'] ?? "asc")
            ->paginate($filter['paginate']);
    }
}
