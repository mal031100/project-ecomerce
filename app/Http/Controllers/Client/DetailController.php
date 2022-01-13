<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSpecification;
use App\Models\Specification;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index($id){
        $item = Product::find($id);
        $description = ProductSpecification::all();
        $specification = Specification::all();
        return view('client.detail.detail', compact('description', 'item', 'specification'));
    }
}
