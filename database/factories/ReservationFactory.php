<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ReservationStatus;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    public function definition(): array
    {
        $deliveryDate = fake()->dateTimeBetween('+1 week', '+3 months');
        $returnDate = fake()->dateTimeBetween($deliveryDate, '+4 months');

        return [
            'customer_id' => Customer::factory(),
            'reservation_date' => now()->format('Y-m-d'),
            'delivery_date' => $deliveryDate->format('Y-m-d'),
            'return_date' => $returnDate->format('Y-m-d'),
            'subtotal' => 0,
            'discount_type' => null,
            'discount_value' => 0,
            'total_amount' => 0,
            'insurance_amount' => fake()->optional(0.6)->randomFloat(2, 100, 1000) ?? 0,
            'status' => ReservationStatus::Pending,
            'notes' => fake()->optional()->sentence(),
            'created_by' => User::factory(),
        ];
    }

    public function cancelled(): static
    {
        return $this->state(['status' => ReservationStatus::Cancelled]);
    }

    public function confirmed(): static
    {
        return $this->state(['status' => ReservationStatus::Confirmed]);
    }
}
