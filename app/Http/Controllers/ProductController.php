<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index() {
        $products = Product::all();
        $sections = Section::all();
        return view('products.index', compact('products', 'sections'));
    }

    public function store(StoreProductRequest $request) {
        Product::create($request->validated());
        session()->flash('success', 'Product created successfully');
        return redirect()->route('products.index');
    }

    public function edit(Product $product) {
        $sections = Section::all();
        return view('products.edit', compact('product', 'sections'));
    }

    public function update(UpdateProductRequest $request, Product $product) {
        $product->update($request->validated());
        session()->flash('success', 'Product updated successfully');
        return redirect()->route('products.index');
    }

    public function destroy(Product $product) {
        $product->delete();
        session()->flash('success', 'Product deleted successfully');
        return redirect()->route('products.index');
    }
}
