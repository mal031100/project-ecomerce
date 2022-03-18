<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function add_cart(Request $request)
    {
        $data = $request->all();
        if (Auth::check()) {
            $session_id = substr(md5(microtime()), rand(00, 26), 10);
            $cart = FacadesSession::get('cart');
            $cart[] = array(
                'session_id' => $session_id,
                'id' => $data['cart_product_id'],
                'name' => $data['cart_product_name'],
                'image' => $data['cart_product_image'],
                'quantity' => $data['cart_product_quantity'],
                'price' => $data['cart_product_price'],
            );
            FacadesSession::put('cart', $cart);
            return redirect()->back();
        } else {
            return response()->json(['status', 'Login to Continue!!!']);
        }
    }

    // public function delete_cart($session_id)
    // {
    //     $cart = FacadesSession::get('cart');
    //     if ($cart == true) {
    //         foreach ($cart as $key => $val) {
    //             if ($val['session_id'] == $session_id) {
    //                 unset($cart[$key]);
    //             }
    //         }
    //         Session::put('cart', $cart);
    //         return redirect()->back()->with('message', 'delete product to cart successfully');
    //     }
    // }
    public function delete_cart(Request $request, $session_id)
    {
        // $cart_id = $request->input('cart_id');
        // $request->session()->forget('sessionid');
        // return response()->json(['status', 'Delete item successfully']);
        $data = $request->find($session_id);
        $cart = FacadesSession::get('cart');
        unset($cart[$session_id], $data);
        FacadesSession::put('cart', $cart);
        return redirect()->back();
    }
}
