<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\PaymentDirection;
use App\Enums\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'amount' => fake()->randomFloat(2, 100, 50000),
            'date' => fake()->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
            'payment_direction' => fake()->randomElement(PaymentDirection::cases()),
            'payment_method' => fake()->randomElement(PaymentMethod::cases()),
            'payment_category_id' => null,
            'customer_id' => null,
            'supplier_id' => null,
            'reservation_id' => null,
            'supplier_bill_id' => null,
            'notes' => fake()->optional()->sentence(),
            'created_by' => User::factory(),
        ];
    }
}
