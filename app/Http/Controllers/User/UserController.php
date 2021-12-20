<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function list(){
        $user = User::orderBy('id', 'asc')->paginate(5);
        return view('user.list', compact('user'));  
    }
    
    public function edit($id){
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->role = $request->input('role');
        $user->update();
        return redirect()->route('user.list')->with('success','User update successfully');
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.list')->with('success','Delete this user successfully');
    }
}
