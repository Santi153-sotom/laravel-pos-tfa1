<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAccountsSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        foreach ([
            ['username' => 'admin.maria', 'full_name' => 'Maria Santos', 'role' => 'Administrator'],
            ['username' => 'jreyes', 'full_name' => 'Joshua Reyes', 'role' => 'Cashier'],
            ['username' => 'acruz', 'full_name' => 'Andrea Cruz', 'role' => 'Inventory Staff'],
            ['username' => 'mgarcia', 'full_name' => 'Miguel Garcia', 'role' => 'Cashier'],
            ['username' => 'smendoza', 'full_name' => 'Sofia Mendoza', 'role' => 'Manager'],
        ] as $user) {
            DB::table('users')->updateOrInsert(
                ['username' => $user['username']],
                [...$user, 'created_at' => $now, 'updated_at' => $now],
            );
        }
    }
}
