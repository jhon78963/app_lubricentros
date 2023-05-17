<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact("products"));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact("categories"));
    }

    public function store(Request $request)
    {
        if (Product::all()->count()) {
            $last_product_id = Product::all()->last()->id+1;
        } else {
            $last_product_id = 1;
        }

        $product = new Product();
        $product->id = $last_product_id;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->code_bar = $last_product_id;
        $product->save();
        return redirect()->route('products.index')->with('datos', 'El producto se ha creado correctamente.');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('products.edit', compact("categories", "product"));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->code_bar = '1';
        $product->save();
        return redirect()->route('products.index')->with('datos', 'El producto se ha actualizado correctamente.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('datos', 'El producto se ha eliminado correctamente.');
    }
}
