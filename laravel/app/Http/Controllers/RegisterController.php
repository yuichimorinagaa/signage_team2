<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registerShow(){
        return view('register.index');
    }
    public function store(RegisterRequest $request)
    {

        $validated=$request->validated();
        User::create([
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password']),

        ]);
        return redirect()->route('login.index')->with('message','登録が完了しました。');
    }
}
