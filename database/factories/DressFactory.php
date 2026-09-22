<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\DressStatus;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class DressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => fake()->unique()->numerify('DR-####'),
            'title' => fake()->words(3, true),
            'description' => fake()->optional()->paragraph(),
            'supplier_id' => fake()->optional(0.8) ? Supplier::factory() : null,
            'category_id' => Category::factory(),
            'size' => fake()->optional()->randomElement(['XS', 'S', 'M', 'L', 'XL', '38', '40', '42']),
            'color' => fake()->optional()->colorName(),
            'purchase_price' => fake()->optional()->randomFloat(2, 5000, 50000),
            'rental_price' => fake()->randomFloat(2, 500, 10000),
            'selling_price' => fake()->optional()->randomFloat(2, 8000, 60000),
            'status' => DressStatus::Available,
            'notes' => fake()->optional()->sentence(),
        ];
    }

    public function available(): static
    {
        return $this->state(['status' => DressStatus::Available]);
    }

    public function reserved(): static
    {
        return $this->state(['status' => DressStatus::Reserved]);
    }
}
