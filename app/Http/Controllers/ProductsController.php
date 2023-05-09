<?php

namespace App\Http\Controllers;


use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    /**
     * Displa127.0.0.1:8000y a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 1) {
                return redirect()->route('products.index')->with('message', 'You are not authorized to perform this action.');
            }
            return $next($request);
        })->only(['create', 'store']);
    }


    public function index()
    {
        $data = Product::all();


        return view('products.index', compact('data'));
    }



    /** 
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // check if the user is an admin
        if (auth()->user()->role !== 1) {
            return redirect()
                ->back()
                ->with('error', 'You do not have permission to perform this action');
        }

        //validate the input from the form
        $this->validate($request, [
            'product_name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required',
            'quantity' => 'required',
            'product_image' => 'required|mimes:jpg,png,jpeg|max:5048'

        ]);
        // uploaded image
        $file_name = time() . '-' . request()->product_name . '.' . $request->product_image->extension();
        $request->product_image->move(public_path('images'), $file_name);

        //dd($pr);

        $product = new Product;
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->image_path = $file_name;
        $product->quantity = $request->quantity;

        $product->save();
        return redirect()->route('products.index')->with('success', 'Product Asdded');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product  $product)
    {
        $cart = Cart::content();
        return view('products.details', compact('product', 'cart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete product using id
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product Deleted');
    }
}
