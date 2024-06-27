<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class LoginController extends Controller
{
    public function show(){
        return view('test.show');
    }
    public function login(Request $request)
    {
        $credentials=$request->validate([
            'email'=>['required','email'],
            'password'=>['required'],
        ],[
            'email.required'=>'メールアドレスを入力してください',
            'password.required'=>'パスワードを入力してください。',
        ]);
        if (Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->route('only.login');
        }
        return redirect()->route('user.index')->withErrors([
            'email'=>'メールアドレスまたはパスワードが間違っています。',
        ]);
    }
}
