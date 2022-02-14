<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public function formlogin(){
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        $login = $request->only('email', 'password');

        if (Auth::attempt($login)) {
            $user = auth()->user();
            Auth::login($user, true);
            return redirect()->route('admin.index');
        }
        return redirect()->route('formlogin')->with('error', 'Incorrect email or password');
    }

    public function formregister(){
        return view('auth.register');
    }

    public function register(RegisterRequest $request){
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

    public function logout(){
        Auth::logout();
        return redirect()->route('formlogin');
    }
}
