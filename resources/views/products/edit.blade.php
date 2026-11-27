@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">Inventory</p>
            <h1>Edit Product</h1>
            <p class="lead">Update product details, stock, or image.</p>
        </div>
    </div>

    <div class="table-wrap" style="padding:24px;">
        <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="name">Product name</label>
            <input id="name" name="name" type="text"
                   value="{{ old('name', $product->name) }}" maxlength="100" required
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 4px;">
            @error('name') <p>{{ $message }}</p> @enderror

            <label for="price">Price (?)</label>
            <input id="price" name="price" type="number" step="0.01" min="0.01"
                   value="{{ old('price', $product->price) }}" required
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 4px;">
            @error('price') <p>{{ $message }}</p> @enderror

            <label for="stock_quantity">Stock quantity</label>
            <input id="stock_quantity" name="stock_quantity" type="number" min="0"
                   value="{{ old('stock_quantity', $product->stock_quantity) }}" required
                   style="display:block; box-sizing:border-box; width:100%; padding:12px; margin:6px 0 4px;">
            @error('stock_quantity') <p>{{ $message }}</p> @enderror

            @if ($product->image)
                <p>Current image:</p>
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}"
                     style="width:120px; height:120px; object-fit:cover; border-radius:10px; margin-bottom:12px;">
            @endif

            <label for="image">Replace image (optional, max 5MB)</label>
            <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp"
                   style="display:block; margin:8px 0 4px;">
            @error('image') <p>{{ $message }}</p> @enderror

            <div style="margin-top:18px;">
                <button type="submit">Update Product</button>
                <a href="{{ route('products.index') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
