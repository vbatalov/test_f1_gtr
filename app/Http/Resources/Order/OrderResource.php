<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "customer" => $this->customer,
            "completed_at" => $this->completed_at,
            "warehouse_id" => $this->warehouse_id,
            "status" => $this->status
        ];
    }
}
