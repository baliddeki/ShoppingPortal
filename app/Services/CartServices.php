<?php
use App\Models\Product;


class CartServices{

    public function addToCart(int $productId): array
{
    // get data from session (this equals Session::get(), use empty array as default)
    $shoppingCart = session('shoppingCart', []);

    if (isset($shoppingCart[$productId]))
    {
        // product is already in shopping cart, increment the amount
        $shoppingCart[$productId]['amount'] += 1;
    }
    else
    {
        // fetch the product and add 1 to the shopping cart
        $product = Product::findOrFail($productId);
        $shoppingCart[$productId] = [
            'productId' => $productId,
            'amount'    => 1,
            'price'     => $product->price->getAmount(),
            'name'      => $product->name,
            'discount'  => $product->discount
        ];
    }

    // update the session data (this equals Session::put() )
    session(['shoppingCart' => $shoppingCart]);
    return $shoppingCart;
}

public function removeFromCart(int $productId): array | null
{
    $shoppingCart = session('shoppingCart', []);

    if (!isset($shoppingCart[$productId]))
    {
        // should not happen, and should throw an error.
        return null;
    }
    else
    {
        if ($shoppingCart[$productId]['amount'] == 1){
            unset($shoppingCart[$productId]);
        }
        else
        {
            $shoppingCart[$productId]['amount'] -= 1;
        }
    }

    session(['shoppingCart' => $shoppingCart]);
    return $shoppingCart;
}
   
}
