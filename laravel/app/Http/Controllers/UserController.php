<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }

    public function create(){
        return view('user.create');
    }
    public function store(Request $request)
    {
        User::create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>$request['password'],

        ]);
        return redirect()->route('user.index');
    }

}
