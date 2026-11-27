<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = Customer::all();

        return view('customers.index', compact('customers'));
    }

    public function create(): View
    {
        return view('customers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
        ]);

        $customer = new Customer();
        $customer->full_name = $validated['full_name'];
        $customer->email = $validated['email'];
        $customer->phone = $validated['phone'] ?? null;
        $customer->save();

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    public function edit(int $id): View
    {
        $customer = Customer::findOrFail($id);

        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
        ]);

        $customer->full_name = $validated['full_name'];
        $customer->email = $validated['email'];
        $customer->phone = $validated['phone'] ?? null;
        $customer->save();

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}