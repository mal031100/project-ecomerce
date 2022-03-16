<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;

session_start();
class CartController extends Controller
{
    public function cart(Request $request)
    {
        $meta_desc = "gio hang cua ban";
        $meta_keywords = "gio hang cua ban";
        $meta_title = "gio hang cua ban";
        $url_canonical = $request->url();

        return view('client.cart.cart')
            ->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)
            ->with('meta_title', $meta_title)->with('url_canonical', $url_canonical);
    }

    // public function save_cart(Request $request){
    //     $productId = $request->id_hidden;
    //     $quantity = $request->amount;
    //     $product_infor = Product::all()->where('id', $productId)->first();

    //     $data['id'] = $product_infor->id;
    //     $data['qty'] = $quantity;
    //     $data['name'] = $product_infor->name;
    //     $data['price'] = $product_infor->price;
    //     $data['weight'] = $product_infor->price;
    //     $data['option']['image'] = $product_infor->image;
    //     Cart::add($data);
    //     return Redirect::to('client/cart'); 
    // }
    public function add_cart(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(00, 26), 10);
        $cart = FacadesSession::get('cart');
        $cart[] = array(
            'sessionId' => $session_id,
            'id' => $data['cart_product_id'],
            'name' => $data['cart_product_name'],
            'image' => $data['cart_product_image'],
            'quantity' => $data['cart_product_quantity'],
            'price' => $data['cart_product_price'],
        );
        FacadesSession::put('cart', $cart);
        return redirect()->back();
    }

    public function delete_cart(Request $request, $session_id)
    {
        $data = $request->find($session_id);
        $cart = FacadesSession::get('cart');
        unset($cart[$session_id], $data);
        FacadesSession::put('cart', $cart);
        return redirect()->back();
    }
}
