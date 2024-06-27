<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;

class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }

    public function create(){
        return view('user.create');
    }
    public function store(CreateUserRequest $request)
    {

        $validated=$request->validated();
        User::create([
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password']),

        ]);
        return redirect()->route('user.index');
    }
    public function admin(){
        $users = User::all();

        return view('user.admin',compact('users'));
    }

    public function delete(Request $request){
        $user=User::find($request['id']);
        $user->delete();

        return redirect()->route('user.admin');
    }
}
