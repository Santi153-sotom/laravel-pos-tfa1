<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->orderBy('name')->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'gt:0', 'max:99999999.99'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:5120'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeProductImage($request->file('image'));
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'gt:0', 'max:99999999.99'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:5120'],
        ]);

        if ($request->hasFile('image')) {
            $oldImage = $product->image;
            $data['image'] = $this->storeProductImage($request->file('image'));
            $product->update($data);

            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        } else {
            unset($data['image']);
            $product->update($data);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product archived.');
    }

    private function storeProductImage(UploadedFile $file): string
    {
        $path = 'products/'.Str::uuid().'.webp';

        $image = Image::read($file->getRealPath())
            ->scaleDown(1200, 1200)
            ->toWebp(82);

        Storage::disk('public')->put($path, (string) $image);

        return $path;
    }
}
