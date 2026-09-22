<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Dress;
use App\Models\Supplier;
use App\Models\SupplierBill;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(PaymentCategorySeeder::class);

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@luminelle.test',
        ]);

        $categories = Category::factory()->count(5)->create();
        $suppliers = Supplier::factory()->count(4)->create();

        Dress::factory()->count(20)->create([
            'category_id' => fn () => $categories->random()->id,
            'supplier_id' => fn () => $suppliers->random()->id,
        ]);

        Customer::factory()->count(10)->create();

        foreach ($suppliers->take(2) as $supplier) {
            SupplierBill::factory()->count(3)->create([
                'supplier_id' => $supplier->id,
                'created_by' => $admin->id,
            ]);
        }
    }
}
