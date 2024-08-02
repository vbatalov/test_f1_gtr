<?php

namespace App\Observers;

use App\Models\History\StockHistory;
use App\Models\Stock;
use Illuminate\Support\Facades\Log;

class StockObserver
{
    /**
     * Handle the Stock "created" event.
     */
    public function created(Stock $stock): void
    {
        //
    }

    /**
     * Handle the Stock "updated" event.
     */
    public function saved(Stock $stock): void
    {
        StockHistory::create([
            "product_id" => $stock->product_id,
            "warehouse_id" => $stock->warehouse_id,
            "stock" => $stock->stock
        ]);
    }

    /**
     * Handle the Stock "deleted" event.
     */
    public function deleted(Stock $stock): void
    {
        //
    }

    /**
     * Handle the Stock "restored" event.
     */
    public function restored(Stock $stock): void
    {
        //
    }

    /**
     * Handle the Stock "force deleted" event.
     */
    public function forceDeleted(Stock $stock): void
    {
        //
    }
}
