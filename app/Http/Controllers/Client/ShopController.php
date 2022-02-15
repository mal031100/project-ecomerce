<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $product = Product::all();
        // $category = Category::where('category_id','=', '')->get();
        return(view('client.shop.shop', compact('category', 'product')));
    }
}
