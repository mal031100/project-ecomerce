<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\InsertRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list(){
        $search = request()->search;
        $category = Category::orderBy('id', 'asc')->where('name', 'like', '%'.$search.'%')->paginate(8);
        return view('admin.category.list', compact('category', 'search'));    
    }
    public function add(){
        $category = Category::all();
        return view('admin.category.add', compact('category'));
    }
    public function insert(InsertRequest $request){
        $category = new Category();
        $category->category_id =$request->input('category_id');
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();
        return redirect()->route('admin.category.list')->with('success', 'Category Add Successfully');
    }
    public function edit($id){
        $category = Category::findOrFail($id);
        $categories = Category::all();
        // dd($categories);
        return view('admin.category.edit', compact('category', 'categories'));
    }

    public function update(UpdateRequest $request, $id){
        $category = Category::findOrFail($id);
        $category->category_id =$request->input('category_id');
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();
        return redirect()->route('admin.category.list')->with('success','Category update successfully');
    }

    public function delete($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.category.list')->with('success','Delete this Category successfully');
    }
}

