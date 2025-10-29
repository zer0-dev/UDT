<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|max:255",
            "art" => "required|max:255",
            "price" => "required",
            "quantity" => "required"
        ]);
        return Product::query()->create($validated);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            "name" => "required|max:255",
            "art" => "required|max:255",
            "price" => "required",
            "quantity" => "required"
        ]);
        $product->update($validated);
        return $product;
    }

    public function destroy(Product $product)
    {
        return $product->delete();
    }
}
