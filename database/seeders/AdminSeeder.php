<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::query()->updateOrCreate([
            'name' => 'Mahmoud Abukhashaba',
            'email' => 'abukhshba77@gmail.com',
            'phone' => '01013367402',
            'password' => '$2y$10$tgKu8/E/N0IhlyDpx27fP.5LwITJf404n.8UjLR/0mj2ikySyYMHu',
            'email_verified_at' => "2023-12-03 15:00:57",
        ]);
        Admin::query()->updateOrCreate([
            'name' => 'Ghada Elganzouri',
            'email' => 'ghada@gmail.com',
            'phone' => '01067989105',
            'password' => '$2y$10$tgKu8/E/N0IhlyDpx27fP.5LwITJf404n.8UjLR/0mj2ikySyYMHu',
            'email_verified_at' => "2023-12-03 15:00:57",
        ]);
    }
}
