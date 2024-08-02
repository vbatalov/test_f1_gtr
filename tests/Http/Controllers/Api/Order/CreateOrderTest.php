<?php

namespace Tests\Http\Controllers\Api\Order;


use App\Models\Stock;
use Tests\TestCase;

class CreateOrderTest extends TestCase
{

    public function test_successful()
    {
        $stock = Stock::factory()->create();

        $response = $this->json("post", route("create-order"),
            [
                "customer" => fake()->name,
                "warehouse_id" => $stock->warehouse_id,
                "products" => [
                    [
                        "id" => $stock->product_id,
                        "count" => $stock->stock
                    ]
                ]
            ]);

        $content = json_decode($response->content(), true);

        $response->assertStatus(201);
        $this->assertDatabaseHas("stocks", [
            "id" => $stock->id,
            "stock" => 0
        ]);

        $this->assertDatabaseHas("products", [
            "id" => $stock->product_id
        ]);

        dump($content);

    }

    public function test_no_stock()
    {
        $stock = Stock::factory()->create();

        $response = $this->json("post", route("create-order"),
            [
                "customer" => fake()->name,
                "warehouse_id" => $stock->warehouse_id,
                "products" => [
                    [
                        "id" => $stock->product_id,
                        "count" => $stock->stock + 1
                    ]
                ]
            ]);

        $content = json_decode($response->content(), true);

        $response->assertStatus(422);
        $this->assertDatabaseHas("stocks", [
            "id" => $stock->id,
            "stock" => $stock->stock
        ]);

        $this->assertDatabaseHas("products", [
            "id" => $stock->product_id
        ]);

        dump($content);

    }
}
