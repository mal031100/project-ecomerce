<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
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

    public function order_detail(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'username' => 'required|max: 50|min:10',
                'useraddress' => 'required|min: 11',
                'userphone' => 'required|min: 10|max: 15',
            ],
            [
                'username.required' => 'No name to blank',
                'username.max' => 'Can only enter up to 50 characters',
                'useraddress.required' => 'No address to blank',
                'userphone.required' => 'No phone-number to blank',
                'userphone.min' => 'Phone number cannot be less than 10 characters',
                'userphone.max' => 'Phone number cannot be more than 15 characters',
            ]
        );
        if ($validate->fails()) {
            $hasError = $validate->errors();
            $errors = [];
            foreach ($hasError->all() as $err) {
                $errors[] = $err;
            }
            return response()->json(
                [
                    'data' => $errors,
                    'status' => 405,
                    'errors' => 'Erorrs',
                ]
            );
        } else {
            $posts = $request->except('_token');
            if ($posts) {
                return view(
                    'client.order.mainorder',
                    compact('posts')
                );
            }
        }
    }

    public function payment()
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "https://localhost:82/client/cart";
        $vnp_TmnCode = "YSU8GSYA"; //Mã website tại VNPAY 
        $vnp_HashSecret = "EXRZPWWGPMHGMICZSYCCLRGBXPSYXRGG"; //Chuỗi bí mật

        $vnp_TxnRef = $_POST['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $_POST['order_desc'];
        $vnp_OrderType = $_POST['order_type'];
        $vnp_Amount = $_POST['amount'] * 100;
        $vnp_Locale = $_POST['language'];
        $vnp_BankCode = $_POST['bank_code'];
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        $vnp_Bill_Email = $_POST['txt_billing_email'];
        $fullName = trim($_POST['txt_billing_fullname']);
        if (isset($fullName) && trim($fullName) != '') {
            $name = explode(' ', $fullName);
            $vnp_Bill_FirstName = array_shift($name);
            $vnp_Bill_LastName = array_pop($name);
        }
        $vnp_Bill_Address = $_POST['txt_inv_addr1'];
        $vnp_Bill_City = $_POST['txt_bill_city'];
        $vnp_Bill_Country = $_POST['txt_bill_country'];
        $vnp_Bill_State = $_POST['txt_bill_state'];
        // Invoice
        $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
        $vnp_Inv_Email = $_POST['txt_inv_email'];
        $vnp_Inv_Customer = $_POST['txt_inv_customer'];
        $vnp_Inv_Address = $_POST['txt_inv_addr1'];
        $vnp_Inv_Company = $_POST['txt_inv_company'];
        $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
        $vnp_Inv_Type = $_POST['cbo_inv_type'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate,
            "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
            "vnp_Bill_Email" => $vnp_Bill_Email,
            "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
            "vnp_Bill_LastName" => $vnp_Bill_LastName,
            "vnp_Bill_Address" => $vnp_Bill_Address,
            "vnp_Bill_City" => $vnp_Bill_City,
            "vnp_Bill_Country" => $vnp_Bill_Country,
            "vnp_Inv_Phone" => $vnp_Inv_Phone,
            "vnp_Inv_Email" => $vnp_Inv_Email,
            "vnp_Inv_Customer" => $vnp_Inv_Customer,
            "vnp_Inv_Address" => $vnp_Inv_Address,
            "vnp_Inv_Company" => $vnp_Inv_Company,
            "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
            "vnp_Inv_Type" => $vnp_Inv_Type
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
}
