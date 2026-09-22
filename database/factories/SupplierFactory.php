<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'address' => fake()->optional()->address(),
            'phone' => fake()->optional()->phoneNumber(),
            'email' => fake()->optional()->safeEmail(),
            'notes' => fake()->optional()->sentence(),
            'is_active' => true,
        ];
    }
}
