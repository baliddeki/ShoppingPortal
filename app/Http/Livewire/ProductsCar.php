<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ProductsCar extends Component
{
    public function render(Product  $product)
    {

        $cart = Cart::content();
        return view('livewire.products-car', compact('product', 'cart'));
    }
}
