<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierBillFactory extends Factory
{
    public function definition(): array
    {
        return [
            'bill_number' => fake()->unique()->numerify('BILL-####'),
            'supplier_id' => Supplier::factory(),
            'total_amount' => fake()->randomFloat(2, 5000, 200000),
            'bill_date' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'delivery_date' => fake()->optional()->dateTimeBetween('now', '+2 months')?->format('Y-m-d'),
            'shipping_fees' => fake()->optional(0.4)->randomFloat(2, 100, 5000) ?? 0,
            'notes' => fake()->optional()->sentence(),
            'created_by' => User::factory(),
        ];
    }
}
