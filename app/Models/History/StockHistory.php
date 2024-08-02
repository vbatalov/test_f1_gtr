<?php

namespace App\Models\History;


use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    public $table = "stock_history";

    protected $fillable = [
        "product_id",
        "warehouse_id",
        "stock",
    ];


}
