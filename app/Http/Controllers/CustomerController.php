<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = Customer::all();

        return view('customers.index', compact('customers'));
    }
}