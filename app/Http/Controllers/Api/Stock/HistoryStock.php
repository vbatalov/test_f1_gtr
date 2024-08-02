<?php

namespace App\Http\Controllers\Api\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\HistoryStockRequest;
use App\Http\Resources\Stock\HistoryStockResource;
use App\Models\History\StockHistory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class HistoryStock extends Controller
{
    public function __invoke(HistoryStockRequest $request)
    {
        $stockHistory = StockHistory::where(function (Builder $builder) use ($request) {
            if ($request->validated("filter.warehouse_id")) {
                $builder->where("warehouse_id", $request->validated("filter.warehouse_id"));
            }
            if ($request->validated("filter.product_id")) {
                $builder->where("product_id", $request->validated("filter.product_id"));
            }
            if ($request->validated("filter.dateFrom")) {
                $builder->where("created_at", ">=", Carbon::parse($request->validated("filter.dateFrom")));
            }
            if ($request->validated("filter.dateTo")) {
                $builder->where("created_at", "<=", Carbon::parse($request->validated("filter.dateTo")));
            }
        })
            ->paginate(30);
        return HistoryStockResource::collection($stockHistory);
    }
}
