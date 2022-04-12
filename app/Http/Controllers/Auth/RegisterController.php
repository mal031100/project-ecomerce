<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function formregister(){
        return view('auth.register');
    }

    public function register(RegisterRequest $request){
        dd($request);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->role = $request->input('role');
        $user->password = bcrypt($request->password);
        $user->save();
        event(new Registered($user));

        auth()->login($user);
        return redirect()->route('formlogin')->with('success', 'Add user successfully');
    }
}
