@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">Inventory</p>
            <h1>Add Product</h1>
            <p class="lead">Enter the product details and optional image.</p>
        </div>
    </div>

    <div class="table-wrap" style="padding:24px;">
        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf

            <label for="name">Product name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" maxlength="100" required
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 4px;">
            @error('name') <p>{{ $message }}</p> @enderror

            <label for="price">Price (?)</label>
            <input id="price" name="price" type="number" step="0.01" min="0.01"
                   value="{{ old('price') }}" required
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 4px;">
            @error('price') <p>{{ $message }}</p> @enderror

            <label for="stock_quantity">Stock quantity</label>
            <input id="stock_quantity" name="stock_quantity" type="number" min="0"
                   value="{{ old('stock_quantity', 0) }}" required
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 4px;">
            @error('stock_quantity') <p>{{ $message }}</p> @enderror

            <label for="image">Product image (optional, max 5MB)</label>
            <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp"
                   style="display:block; margin:8px 0 4px;">
            @error('image') <p>{{ $message }}</p> @enderror

            <div style="margin-top:18px;">
                <button type="submit">Save Product</button>
                <a href="{{ route('products.index') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
