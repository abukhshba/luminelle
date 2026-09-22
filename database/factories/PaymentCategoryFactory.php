<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\PaymentDirection;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2, true),
            'direction' => fake()->randomElement(PaymentDirection::cases()),
            'is_active' => true,
        ];
    }

    public function incoming(): static
    {
        return $this->state(['direction' => PaymentDirection::In]);
    }

    public function outgoing(): static
    {
        return $this->state(['direction' => PaymentDirection::Out]);
    }
}
