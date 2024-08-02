<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Stock;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        Order::factory(5)->create();
        Stock::factory(5)->create();
    }
}
