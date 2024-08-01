<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
