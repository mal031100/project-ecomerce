<?php

namespace App\Http\Controllers\Client;

use Gloudemans\Shoppingcart\Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function save_cart(Request $request)
    {  
        $product = Product::findOrFail($request->input('id'));
        Cart::add(
            $product->id, 
            $product->name, 
            $product->input('amount'), 
            $product->price,
        );
        return redirect()->route('Client.cart')->with('message', 'Successfully added');
    }
    public function cart(){
        // $cart = Cart::content();
        return view('client.cart.cart');
    }
}
