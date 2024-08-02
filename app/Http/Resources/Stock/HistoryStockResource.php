<?php

namespace App\Http\Resources\Stock;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryStockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "product_id" => $this->product_id,
            "warehouse_id" => $this->warehouse_id,
            "stock" => $this->stock,
            "created_at" => $this->created_at,
        ];
    }
}
