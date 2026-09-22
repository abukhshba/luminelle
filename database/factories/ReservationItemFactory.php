<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Dress;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationItemFactory extends Factory
{
    public function definition(): array
    {
        $price = fake()->randomFloat(2, 500, 10000);
        $discount = fake()->optional(0.3)->randomFloat(2, 0, $price * 0.2) ?? 0;

        return [
            'reservation_id' => Reservation::factory(),
            'dress_id' => Dress::factory(),
            'price' => $price,
            'discount' => $discount,
            'total' => $price - $discount,
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
