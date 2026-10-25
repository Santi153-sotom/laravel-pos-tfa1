<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = [
            ['id' => 1, 'username' => 'admin.maria', 'full_name' => 'Maria Santos', 'role' => 'Administrator'],
            ['id' => 2, 'username' => 'jreyes', 'full_name' => 'Joshua Reyes', 'role' => 'Cashier'],
            ['id' => 3, 'username' => 'acruz', 'full_name' => 'Andrea Cruz', 'role' => 'Inventory Staff'],
            ['id' => 4, 'username' => 'mgarcia', 'full_name' => 'Miguel Garcia', 'role' => 'Cashier'],
            ['id' => 5, 'username' => 'smendoza', 'full_name' => 'Sofia Mendoza', 'role' => 'Manager'],
        ];

        return view('users.index', compact('users'));
    }
}
