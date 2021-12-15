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
        $search = request()->search;
        $product = Product::orderBy('id', 'asc')->where('name', 'like', '%'.$search.'%')->paginate(5);
        return view('admin.product.list', compact('product', 'search'));    
    }
    public function add(){
        $user = User::orderBy('name','asc')->select('id', 'name')->get();
        $category = Category::all();
        return view('admin.product.add', compact('category', 'user'));
    }
    public function insert(Request $request){
        $product = new Product();
        $request->validate([
            'category_id' => 'required',
            'user_id' => 'required',
            'name' => 'required|max:30|unique:products,name',
            'price' => 'required',
            'sale' => 'required',
            'amount' => 'required',
        ],[
            // 'name.unique' => 'Tên đã tồn tại',
            // 'name.max' => 'Tên quá dài',
            // 'name.required' => 'Không được để trống tên',
            // 'price.required' => 'Không được để trống giá',
            // 'sale.required' => 'Không được để trống giá',
            // 'amount.required' => 'Không được để trống giá'
        ]);
        
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

    public function update(Request $request, $id){
        $product = Product::find($id);
        $request->validate([
            'name' => 'required|min:5|max:30|unique:products,name',
            'price' => 'required',
            'sale' => 'required',
            'amount' => 'required',
        ]);
        // $product->category_id =$request->input('category_id');
        // $product->user_id = $request->input('user_id');
        $product->name =$request->input('name');
        $product->price =$request->input('price');
        $product->sale =$request->input('sale');
        $product->amount =$request->input('amount');
        if($request->hasFile('image')){
            $path = 'resources/assets1/upload/product/'.$product->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('resources/assets1/upload/product/',$filename);
            $product->image = $filename;
        }
        $product->update();
        return redirect()->route('admin.product.list')->with('success','Product update successfully');
    }

    public function delete($id){
        $product = Product::find($id);
        $path = 'resources/assets1/upload/product/'.$product->image;
            if(File::exists($path))
            {
                File::unlink($path);
            }
        $product->delete();
        return redirect()->route('admin.product.list')->with('success','Delete this product successfully');
    }
}
