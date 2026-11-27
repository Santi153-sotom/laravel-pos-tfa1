<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['product', 'customer', 'staff'])
            ->latest()
            ->paginate(20);

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::query()
            ->where('stock_quantity', '>', 0)
            ->orderBy('name')
            ->get();

        $customers = Customer::query()
            ->orderBy('full_name')
            ->get();

        return view('sales.create', compact('products', 'customers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'customer_id' => ['nullable', 'integer', 'exists:customers,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($data): void {
            $product = Product::query()
                ->whereKey($data['product_id'])
                ->lockForUpdate()
                ->firstOrFail();

            $quantity = (int) $data['quantity'];

            if ($quantity > $product->stock_quantity) {
                throw ValidationException::withMessages([
                    'quantity' => "Only {$product->stock_quantity} units are currently in stock.",
                ]);
            }

            $updated = Product::query()
                ->whereKey($product->id)
                ->where('stock_quantity', '>=', $quantity)
                ->decrement('stock_quantity', $quantity);

            if ($updated !== 1) {
                throw ValidationException::withMessages([
                    'quantity' => 'The available stock changed. Please try again.',
                ]);
            }

            Sale::create([
                'product_id' => $product->id,
                'customer_id' => $data['customer_id'] ?? null,
                'sold_by' => auth()->id(),
                'quantity' => $quantity,
                'total_price' => round((float) $product->price * $quantity, 2),
            ]);
        });

        return redirect()->route('sales.index')->with('success', 'Sale recorded and stock updated.');
    }
}
