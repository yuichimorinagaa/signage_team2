<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminShow(){
        $users = User::all();

        return view('admin.index',compact('users'));
    }

    public function delete(Request $request){
        $user=User::find($request['id']);
        $user->delete();

        return redirect()->route('admin.index');
    }
}
