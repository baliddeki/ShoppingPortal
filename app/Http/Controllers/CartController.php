<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        $CART = Cart::add([
            'id' => $product->id,
            'name' => $product->product_name,
            'qty' => $request->input('quantity'),
            'price' => $product->price,
            'weight' => 550,
            'options' => [
                'image_path' => $product->image_path,
            ]
        ]);

        return redirect()->route('products.index')->with('message', 'Product successfully added to cart!!');
    }

    public function viewcart()
    {
        $cartItem = Cart::content();
        $subtotal = Cart::subtotal();
        return view('cart.cart_items', compact('cartItem', 'subtotal'));
    }

    //q: why is it hard to learn live wire in laravel


    public function removeProductFromCart($productId)
    {

        Cart::remove($productId);
        return redirect()->route('cart.store')->with('message', 'Product removed from cart successfully!');
    }

    public function removeAllProductsFromCart()
    {

        Cart::destroy();
        return redirect()->route('cart.store')->with('message', 'All Products removed from cart successfully!');
    }
}
