<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function loginShow(){
        return view('login.index');
    }
    public function show(){
        return view('test.show');
    }
    public function login(LoginRequest $request)
    {
        $credentials=$request->only('email','password');

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();

            if (Auth::user()->status == 1){
               return redirect()->route('admin.select');
            }
            return redirect()->route('file.index');
        }
        return redirect()->route('login.index')->withErrors([
            'email'=>'メールアドレスまたはパスワードが間違っています。',
        ]);
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.index')->with([
            'message'=>'ログアウトしました'
        ]);
    }
}

