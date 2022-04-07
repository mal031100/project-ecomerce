<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\PaymentRequest;
use App\Models\Product;
use App\Models\User;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;
use SebastianBergmann\Environment\Console;

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
                'useremail' => 'required|email|min: 11',
                'userphone' => 'required|min: 10|max: 15',
            ],
            [
                'username.required' => 'No name to blank',
                'username.max' => 'Can only enter up to 50 characters',
                'useraddress.required' => 'No address to blank',
                'useremail.required' => 'No email to blank',
                'useremail.email' => 'Please enter correct email format',
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

    public $returnData = [];

    public function payment(PaymentRequest $request)
    {
        $code_id = time() . "";
        $info_data = $request->all();
        $infor_name = $info_data['username'];
        $infor_email = $info_data['useremail'];
        $infor_phone = $info_data['userphone'];
        $infor_address = $info_data['useraddress'];
        $infor_paymentMethod = $info_data['paymentMethod'];
        $infor_paymentTotal = 9999000;
        // dd($info_data);
        // if ($infor_paymentMethod == "vnpay") {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        // dd($infor_paymentTotal);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";

        $vnp_TxnRef = $code_id;
        $vnp_OrderInfo = 'Payment orders';
        $vnp_OrderType = 'Billpayment';
        $vnp_Amount = $infor_paymentTotal * 100;
        $vnp_Locale = 'VND';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => config('app.vnp_tmn_code'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => route('client.vnpayreturn'),
            "vnp_TxnRef" => $vnp_TxnRef
        );
        // dd($inputData);
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
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

        $vnp_Url = config('app.vnp_url') . "?" . $query;

        if (config('app.vnp_has')) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, config('app.vnp_has'));
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = [
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url,
            "InforName" => $infor_name,
            "InforEmail" => $infor_email,
            "InforPhone" => $infor_phone,
            "InforAddress" => $infor_address,
            "InforPaymentMethod" => $infor_paymentMethod,
            "InforPaymentTotal" => $infor_paymentTotal,
            "orderId" => $vnp_TxnRef,
        ];
        session()->put($returnData);
        return response()->json($returnData);
        // }

    }

    public function vnpayReturn(Request $request)
    {
        $infor = $request->session()->all();
        dd($infor);
        $check_order_code = DB::table('orders')->where('code_order', $infor['orderId'])->exists();

        if ($check_order_code == true) {
            $products = Product::all();
            return view('client.cart.cart', compact('products'));
        } else {
            if ($request->vnp_ResponseCode === '00') {
                try {
                    DB::beginTransaction();
                    $vnpayData = $request->all();
                    $infor = $request->session()->all();

                    $name_products = DB::table('products')
                        ->select('id', 'name', 'price')
                        ->get();
                    $products_info = [];
                    // foreach ($infor['InforProduct'] as $info) {
                    //     $arr = [
                    //         'id' => $info['id'],
                    //         'name' => null,
                    //         'price' => 0,
                    //         'value' => $info['value']
                    //     ];
                        foreach ($name_products as $item) {
                            if ($item->id == $item->id) {
                                $arr['name'] = $item->name;
                                $arr['price'] = $item->price;
                            }
                        }
                        $products_info[] = $arr;
                    // }

                    $orders_id = DB::table('orders')
                        ->insertGetId(
                            [
                                'code_order' => $infor['orderId'],
                                'full_name' => $infor['InforName'],
                                'address' => $infor['InforAdress'],
                                'email' => $infor['InforEmail'],
                                'phone' => $infor['InforPhone'],
                                'total' => $infor['InforTotal'],
                                // 'actual_total' => $infor['InforPaymentTotal'],
                                // 'payment_method' => $infor['InforPaymentMethod'],
                                'created_at' => Carbon::now(),
                            ]
                        );
                    foreach ($infor['InforProduct'] as $item) {
                        DB::table('order_detail')
                            ->insert(
                                [
                                    'order_id' => $orders_id,
                                    'product_id' => $item['id'],
                                    'quantity' => $item['value'],
                                    'created_at' => Carbon::now(),
                                ]
                            );
                    }

                    DB::commit();
                    $to_name = $infor['InforName'];
                    $to_email = $infor['InforEmail'];

                    Mail::send(
                        'user.mail.form_email',
                        compact('infor', 'products_info'),
                        function ($message) use ($to_name, $to_email) {
                            $message->to($to_email)->subject('Product information');
                            $message->from($to_email, $to_name);
                        }
                    );
                    session()->flush();
                    return view('client.payment.vnpay_return');
                } catch (Exception $exception) {
                    $request->session()->flash('message', 'ERROR! AN ERROR OCCURRED. PLEASE TRY AGAIN LATER!');
                }
            } else {
                $request->session()->flash('status', 'ERROR! AN ERROR OCCURRED. PLEASE TRY AGAIN LATER!');
                return view('client.master');
            }
        }
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
}
