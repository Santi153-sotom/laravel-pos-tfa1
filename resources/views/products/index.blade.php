@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">Inventory</p>
            <h1>Products</h1>
            <p class="lead">Manage products, prices, images, and available stock.</p>
        </div>
        <a href="{{ route('products.create') }}">+ Add Product</a>
    </div>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <div class="table-wrap" style="padding: 24px; overflow-x: auto;">
        @if ($products->isEmpty())
            <p>No active products yet. Add your first product.</p>
        @else
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr>
                        <th style="text-align:left; padding:12px;">Image</th>
                        <th style="text-align:left; padding:12px;">Product</th>
                        <th style="text-align:left; padding:12px;">Price</th>
                        <th style="text-align:left; padding:12px;">Stock</th>
                        <th style="text-align:left; padding:12px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td style="padding:12px;">
                                @if ($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}"
                                         alt="{{ $product->name }}"
                                         style="width:64px; height:64px; object-fit:cover; border-radius:10px;">
                                @else
                                    No image
                                @endif
                            </td>
                            <td style="padding:12px;">{{ $product->name }}</td>
                            <td style="padding:12px;">&#8369;{{ number_format((float) $product->price, 2) }}</td>
                            <td style="padding:12px;">{{ $product->stock_quantity }}</td>
                            <td style="padding:12px;">
                                <a href="{{ route('products.edit', $product) }}">Edit</a>

                                <form method="POST"
                                      action="{{ route('products.destroy', $product) }}"
                                      style="display:inline;"
                                      onsubmit="return confirm('Archive this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Archive</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top:20px;">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection