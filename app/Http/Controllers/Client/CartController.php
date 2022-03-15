<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

// session_start();
class CartController extends Controller
{   
    public function cart(Request $request){
        $meta_desc = "gio hang cua ban";
        $meta_keywords = "gio hang cua ban";
        $meta_title = "gio hang cua ban";
        $url_canonical = $request->url();
        
        return view('client.cart.cart')
            ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
            ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }

    public function save_cart(Request $request){
        $productId = $request->id_hidden;
        $quantity = $request->amount;
        $product_infor = Product::all()->where('id', $productId)->first();

        $data['id'] = $product_infor->id;
        $data['qty'] = $quantity;
        $data['name'] = $product_infor->name;
        $data['price'] = $product_infor->price;
        $data['weight'] = $product_infor->price;
        $data['option']['image'] = $product_infor->image;
        Cart::add($data);
        return Redirect::to('client/cart'); 
    }
    public function add_cart(Request $request){
        $data = $request->all();
        dd($data);
        $session_id = substr(md5(microtime()), rand(0,26),5);
        $cart = Session::get('cart');
        
        if ($cart == true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id'] == $data['product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_id' => $data['cart_product_id'],
                    'product_name' => $data['cart_product_name'],
                    'product_image' => $data['cart_product_image'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_id' => $data['cart_product_id'],
                'product_name' => $data['cart_product_name'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_price' => $data['cart_product_price'],
            );
            Session::put('cart', $cart);
        }
        Session::save();
    }
}
