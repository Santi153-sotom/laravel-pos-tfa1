<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('customers')->insert([
            ['full_name' => 'Ana Santos', 'email' => 'ana.santos@example.com', 'phone' => '09171234567'],
            ['full_name' => 'Ben Reyes', 'email' => 'ben.reyes@example.com', 'phone' => '09181234567'],
            ['full_name' => 'Carla Cruz', 'email' => 'carla.cruz@example.com', 'phone' => '09191234567'],
            ['full_name' => 'Daniel Garcia', 'email' => 'daniel.garcia@example.com', 'phone' => '09201234567'],
            ['full_name' => 'Ella Flores', 'email' => 'ella.flores@example.com', 'phone' => '09211234567'],
        ]);

        DB::table('users')->insert([
            ['username' => 'admin', 'full_name' => 'Alex Manager'],
            ['username' => 'cashier1', 'full_name' => 'Jamie Lim'],
            ['username' => 'cashier2', 'full_name' => 'Morgan Tan'],
            ['username' => 'cashier3', 'full_name' => 'Riley Diaz'],
            ['username' => 'cashier4', 'full_name' => 'Taylor Lee'],
        ]);
    }
}