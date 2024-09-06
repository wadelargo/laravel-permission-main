<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    public function edit($id) {
        abort_if(Gate::denies('edit product'), 403);
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('products')->with('error', 'Product not found.');
        }

        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, $id) {
        abort_if(Gate::denies('update product'), 403);
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('products')->with('error', 'Product not found.');
        }

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->save();

        $log_entry = 'Updated a new product ' . $product->name . ' with the ID# of ' . $product->id;
        event(new UserLog($log_entry));

        return redirect()->route('products')->with('success', 'Product updated successfully.');
    }

    public function destroy($id) {
        abort_if(Gate::denies('delete product'), 403);
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('products')->with('error', 'Product not found.');
        }

        $product->delete();

        $log_entry = 'Deleted a product ' . $product->name . ' with the ID# of ' . $product->id;
        event(new UserLog($log_entry));

        return redirect()->route('products')->with('success', 'Product deleted successfully.');
    }

    public function create() {
        abort_if(Gate::denies('create product'), 403);
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validate the request...
        abort_if(Gate::denies('store product'), 403);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            
        ]);
    
        // Create a new product...
        $product = Product::create($validatedData);

        $log_entry = 'Added a new product ' . $product->name . ' with the ID# of ' . $product->id;
        event(new UserLog($log_entry));
    
        // Redirect to the products list...
        return redirect()->route('products')->with('success', 'Product created successfully.');
    }

    public function logs()
    {
        abort_if(Gate::denies('visit logs'), 403);
        $logs = auth()->user()->logs;
        return view('products.logs', compact('logs'));
    }
    
    
}

