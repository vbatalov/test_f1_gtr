<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable =
        [
            "customer",
            "completed_at",
            "warehouse_id",
            "status",
        ];
    protected $casts = [
        "status" => StatusEnum::class
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
