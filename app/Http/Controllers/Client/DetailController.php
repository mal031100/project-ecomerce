<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSpecification;
use App\Models\Specification;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id);
        $description = ProductSpecification::all();
        $specification = Specification::all();
        return view('client.detail.detail', compact('description', 'product', 'specification'));
    }
}