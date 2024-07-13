<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminShow(){
        $users = User::all();

        return view('admin.index',compact('users'));
    }

    public function delete(Request $request){
        $user=User::find($request['id']);
        if($user->id==$request['id']){
            $user->delete();
            return redirect()->route('admin.index');


        }

        return redirect()->route('admin.index')->withErrors('User not found');
    }
}
