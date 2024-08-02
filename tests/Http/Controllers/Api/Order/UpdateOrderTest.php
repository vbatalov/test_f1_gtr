<?php

namespace Tests\Http\Controllers\Api\Order;

use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use Tests\TestCase;

class UpdateOrderTest extends TestCase
{

    public function test_successful()
    {
        $order = Order::factory()->create();
        $product = Product::factory()->create();
        $stock = Stock::create([
            "product_id" => $product->id,
            "warehouse_id" => $order->warehouse_id,
            "stock" => 100
        ]);

        $new_stock = Stock::create([
            "product_id" => Product::factory()->create()->id,
            "warehouse_id" => $order->warehouse_id,
            "stock" => 1
        ]);

        $data = [
            "id" => $order->id,
            "customer" => fake()->name,
            "warehouse_id" => $order->warehouse_id,
            "products" => [
                [
                    "id" => $stock->product_id,
                    "count" => 1,
                ],
                [
                    "id" => $new_stock->product_id,
                    "count" => 1
                ]
            ]
        ];

        $response = $this->json("PUT", route("update-order"), $data);
        $response->assertStatus(200);

        $content = json_decode($response->content(),true);

        dump($content);
    }
    public function test_no_stock()
    {
        $order = Order::factory()->create();
        $product = Product::factory()->create();
        $stock = Stock::create([
            "product_id" => $product->id,
            "warehouse_id" => $order->warehouse_id,
            "stock" => 100
        ]);

        $new_stock = Stock::create([
            "product_id" => Product::factory()->create()->id,
            "warehouse_id" => $order->warehouse_id,
            "stock" => 100
        ]);

        $data = [
            "id" => $order->id,
            "customer" => fake()->name,
            "warehouse_id" => $order->warehouse_id,
            "products" => [
                [
                    "id" => $stock->product_id,
                    "count" => 1,
                ],
                [
                    "id" => $new_stock->product_id,
                    "count" => 101,
                ]
            ]
        ];

        $response = $this->json("PUT", route("update-order"), $data);
        $response->assertStatus(422);

        $content = json_decode($response->content(),true);

        dump($content);
    }
}
