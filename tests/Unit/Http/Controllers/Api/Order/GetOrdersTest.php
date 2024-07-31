<?php

namespace Http\Controllers\Api\Order;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetOrdersTest extends TestCase
{

    use RefreshDatabase;
    public function test__invoke()
    {
        Order::factory(10)->make();

        $response = $this->get(route("get-orders"));

        $response->assertStatus(200);

        $this->assertNotEmpty($response->content());
    }
}
