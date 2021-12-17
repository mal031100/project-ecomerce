<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\support\Facades\File;
use App\Http\Requests\product\InsertRequest;
use App\Http\Requests\Product\UpdateRequest;

class ProductController extends Controller
{
    public function list(){
        $search = request()->search;
        $product = Product::orderBy('id', 'asc')->where('name', 'like', '%'.$search.'%')->paginate(5);
        return view('admin.product.list', compact('product', 'search'));    
    }
    public function add(){
        $category = Category::all();
        return view('admin.product.add', compact('category'));
    }
    public function insert(InsertRequest $request){
        $product = new Product();
        $product->category_id =$request->input('category_id');
        $product->user_id = $request->input('user_id');
        $product->name =$request->input('name');
        $product->price =$request->input('price');  
        $product->sale =$request->input('sale');
        $product->amount =$request->input('amount');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets1/upload/product/',$filename);
            $product->image = $filename;
        }
        $product->save();
        return redirect()->route('admin.product.list')->with('success', 'Product Add Successfully');
    }

    public function edit($id){
        $category = Category::all();
        $product = Product::find($id);
        return view('admin.product.edit', compact('product', 'category'));
    }

    public function update(UpdateRequest $request, $id){
        $product = Product::find($id);
        // $product->category_id =$request->input('category_id');
        // $product->user_id = $request->input('user_id');
        $product->name =$request->input('name');
        $product->price =$request->input('price');
        $product->sale =$request->input('sale');
        $product->amount =$request->input('amount');
        if($request->hasFile('image')){
            $path = 'assets1/upload/product/'.$product->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets1/upload/product/',$filename);
            $product->image = $filename;
        }
        $product->update();
        return redirect()->route('admin.product.list')->with('success','Product update successfully');
    }

    public function delete($id){
        $product = Product::find($id);
        $path = 'assets1/upload/product/'.$product->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
        $product->delete();
        return redirect()->route('admin.product.list')->with('success','Delete this product successfully');
    }
}
