<?php

namespace Tests\Http\Controllers\Api\Order;

use App\Enums\StatusEnum;
use App\Models\Order;
use App\Models\Stock;
use Tests\TestCase;

class ResumeOrderTest extends TestCase
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

//        dump("whID: {$stock->warehouse_id}");
//        dump("prodID: {$stock->product_id}");
//        dump("stock: {$stock->stock}");

        $order = Order::findOrFail($response['order']['id']);
        $order->update([
            "status" => StatusEnum::CANCELED
        ]);
        $stock->update([
            "stock" => 100
        ]);


        $content = json_decode($response->content(), true);
        $response->assertStatus(201);
//        dump($content);

        $response = $this->call("PATCH", route("resume-order"), [
            "id" => $response['order']['id']
        ]);
        $response->assertStatus(200);

        $content = json_decode($response->content(), true);


//        dump($content);
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
                        "count" => $stock->stock
                    ]
                ]
            ]);

//        dump("whID: {$stock->warehouse_id}");
//        dump("prodID: {$stock->product_id}");
//        dump("stock: {$stock->stock}");

        $order = Order::findOrFail($response['order']['id']);
        $order->update([
            "status" => StatusEnum::CANCELED
        ]);
        $stock->update([
            "stock" => 1
        ]);


        $content = json_decode($response->content(), true);
        $response->assertStatus(201);
//        dump($content);

        $response = $this->call("PATCH", route("resume-order"), [
            "id" => $response['order']['id']
        ]);
        $response->assertStatus(422);

        $content = json_decode($response->content(), true);


        dump($content);
    }
}
