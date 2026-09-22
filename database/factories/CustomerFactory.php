<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'whatsapp' => fake()->optional()->phoneNumber(),
            'email' => fake()->optional()->safeEmail(),
            'address' => fake()->optional()->address(),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
