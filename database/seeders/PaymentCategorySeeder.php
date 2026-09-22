<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\PaymentDirection;
use App\Models\PaymentCategory;
use Illuminate\Database\Seeder;

class PaymentCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Reservation Payment', 'direction' => PaymentDirection::In],
            ['name' => 'Insurance Deposit', 'direction' => PaymentDirection::In],
            ['name' => 'Other Income', 'direction' => PaymentDirection::In],
            ['name' => 'Supplier Bill', 'direction' => PaymentDirection::Out],
            ['name' => 'Insurance Refund', 'direction' => PaymentDirection::Out],
            ['name' => 'Rent', 'direction' => PaymentDirection::Out],
            ['name' => 'Electricity', 'direction' => PaymentDirection::Out],
            ['name' => 'Water', 'direction' => PaymentDirection::Out],
            ['name' => 'Salary', 'direction' => PaymentDirection::Out],
            ['name' => 'Maintenance', 'direction' => PaymentDirection::Out],
            ['name' => 'Other Expense', 'direction' => PaymentDirection::Out],
        ];

        foreach ($categories as $category) {
            PaymentCategory::firstOrCreate(
                ['name' => $category['name']],
                ['direction' => $category['direction'], 'is_active' => true]
            );
        }
    }
}
