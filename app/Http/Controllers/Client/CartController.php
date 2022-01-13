<?php

namespace App\Http\Controllers\Client;

use Gloudemans\Shoppingcart\Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function save_cart(Request $request, $id)
    {   
        $total = 0;
        // $id = $request->input('id');
        // $quantity = $request->input('amount');
        // $getpro = Product::find($id);
        // $name = $getpro->name;
        // $image = $getpro->image;
        // $price = $getpro->sale;
        $product = Product::find($id);
        $name = $product->name;
        $image = $product->image;
        $quantity = $product->amount;
        $price = $product->sale;

        $data = [
            'id' => $id,
            'qty' => $quantity,
            'name' => $name,
            'price' => $price,
            'options' => [
                'image' => $image,
            ],
            'total' => [$total + ($price * $quantity)],
        ];
        Cart::add($data);

        return redirect()->back();
    }
    public function cart(){
        return view('client.cart.cart');
    }
}
