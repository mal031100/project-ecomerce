<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\support\Facades\File;

class ProductController extends Controller
{
    public function list(){

        $product= Product::orderBy('id','asc')->paginate(5);
        if($search = request()->search){
            $product = Product::orderBy('created_at', 'DESC')->where('name','like','%'.$search.'%')->paginate(5);
        }
        return view('admin.product.list', compact('product'));
    }
    public function add(){
        $user = User::all();
        $category = Category::all();
        return view('admin.product.add', compact('category', 'user'));
    }
    public function insert(Request $request){
        $product = new Product();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('asset1/upload/product/',$filename);
            $product->image = $filename;
        }
        $product->category_id =$request->input('category_id');
        $product->user_id = $request->input('user_id');
        $product->name =$request->input('name');
        $product->price =$request->input('price');
        $product->sale =$request->input('sale');
        $product->amount =$request->input('amount');
        $product->save();
        return redirect('amin/product')->with('status', "Product added successfully");
    }

    public function edit($id){
        $product = Product::find($id);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        if($request->hasFile('image')){
            $path = 'assets1/upload/product/'.$product->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('asset1/upload/product/',$filename);
            $product->image = $filename;
        }
        // $product->category_id =$request->input('category_id');
        // $product->user_id = $request->input('user_id');
        $product->name =$request->input('name');
        $product->price =$request->input('price');
        $product->sale =$request->input('sale');
        $product->amount =$request->input('amount');
        $product->update();
        return redirect('amin/product')->with('status', "Product update successfully");
    }

    public function delete($id){
        $product = Product::find($id);
        $path = 'assets1/upload/product/'.$product->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
        $product->delete();
        return redirect('amin/product')->with('status', "Product deleted successfully");
    }
}
