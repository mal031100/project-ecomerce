<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        $data['tivi'] = Product::where('category_id',1)->get();
        $data['tulanh'] = Product::where('category_id',5)->get();
        $data['maygiat'] = Product::where('category_id',3)->get();
        $data['product'] = Product::all();
        return view('client.master', $data);
    }
}
