<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerAccountsSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        foreach ([
            ['full_name' => 'Maria Santos', 'email' => 'maria.santos@example.com', 'phone' => '0917-555-0101'],
            ['full_name' => 'Joshua Reyes', 'email' => 'joshua.reyes@example.com', 'phone' => '0917-555-0102'],
            ['full_name' => 'Andrea Cruz', 'email' => 'andrea.cruz@example.com', 'phone' => '0917-555-0103'],
            ['full_name' => 'Miguel Garcia', 'email' => 'miguel.garcia@example.com', 'phone' => '0917-555-0104'],
            ['full_name' => 'Sofia Mendoza', 'email' => 'sofia.mendoza@example.com', 'phone' => '0917-555-0105'],
        ] as $customer) {
            DB::table('customers')->updateOrInsert(
                ['email' => $customer['email']],
                [...$customer, 'created_at' => $now, 'updated_at' => $now],
            );
        }
    }
}
