<?php

namespace App\Models;

use App\Observers\StockObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(classes: [StockObserver::class])]
class Stock extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $table = "stocks";

    protected $fillable = [
        "product_id",
        "warehouse_id",
        "stock"
    ];

    protected $casts = [
        "stock" => "integer"
    ];

}
