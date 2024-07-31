<?php

namespace Database\Factories;

use App\Enums\StatusEnum;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "customer" => fake()->name,
            "completed_at" => fake()->dateTime(),
            "warehouse_id" => Warehouse::factory()->create(),
            "status" => fake()->randomElement(StatusEnum::cases())
        ];
    }
}
