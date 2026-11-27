@extends('layouts.app')

@section('title', 'Record Sale')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">Point of sale</p>
            <h1>Record Sale</h1>
            <p class="lead">Choose a product, enter the quantity, and optionally select a customer.</p>
        </div>
    </div>

    <div class="table-wrap" style="padding:24px;">
        @if ($products->isEmpty())
            <p>No products with available stock. Add a product or update its stock first.</p>
            <a href="{{ route('products.create') }}">Add Product</a>
        @else
            <form method="POST" action="{{ route('sales.store') }}">
                @csrf

                <label for="product_id">Product</label>
                <select id="product_id" name="product_id" required
                        style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 4px;">
                    <option value="">Choose a product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" @selected(old('product_id') == $product->id)>
                            {{ $product->name }} ? ?{{ number_format((float) $product->price, 2) }}
                            ? {{ $product->stock_quantity }} in stock
                        </option>
                    @endforeach
                </select>
                @error('product_id') <p>{{ $message }}</p> @enderror

                <label for="customer_id">Customer (optional)</label>
                <select id="customer_id" name="customer_id"
                        style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 4px;">
                    <option value="">Walk-in customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>
                            {{ $customer->full_name }}
                        </option>
                    @endforeach
                </select>
                @error('customer_id') <p>{{ $message }}</p> @enderror

                <label for="quantity">Quantity</label>
                <input id="quantity" name="quantity" type="number" min="1" step="1"
                       value="{{ old('quantity', 1) }}" required
                       style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 4px;">
                @error('quantity') <p>{{ $message }}</p> @enderror

                <div style="margin-top:18px;">
                    <button type="submit">Record Sale</button>
                    <a href="{{ route('sales.index') }}">Cancel</a>
                </div>
            </form>
        @endif
    </div>
@endsection
