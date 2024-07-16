<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function deleteFile($id)
    {
        $file = File::find($id);
        if($file){
            Storage::delete($file->file_path);
            $file->delete();
        }
        return redirect()->route('admin.index');
    }
}
