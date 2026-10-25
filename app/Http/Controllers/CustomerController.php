<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = [
            ['id' => 1, 'full_name' => 'Maria Santos', 'email' => 'maria.santos@example.com', 'phone' => '0917-555-0101'],
            ['id' => 2, 'full_name' => 'Joshua Reyes', 'email' => 'joshua.reyes@example.com', 'phone' => '0917-555-0102'],
            ['id' => 3, 'full_name' => 'Andrea Cruz', 'email' => 'andrea.cruz@example.com', 'phone' => '0917-555-0103'],
            ['id' => 4, 'full_name' => 'Miguel Garcia', 'email' => 'miguel.garcia@example.com', 'phone' => '0917-555-0104'],
            ['id' => 5, 'full_name' => 'Sofia Mendoza', 'email' => 'sofia.mendoza@example.com', 'phone' => '0917-555-0105'],
        ];

        return view('customers.index', compact('customers'));
    }
}
