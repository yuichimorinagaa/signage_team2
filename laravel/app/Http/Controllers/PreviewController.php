<?php

namespace App\Http\Controllers;

use App\Model\File;
use Illuminate\Http\Request;

class PreviewController extends Controller
{
    public function index(){
        $files = File::All();
        return view('user.preview', compact('files'));
    }

    public function update(Request $request){
        if($request->has('files')){
            File::whereIn('id', $request->input('files'))->update(['status' => 1]);
        }

        return redirect()->route('preview.index')->with('success', '更新しました');
    }


    public function back(){
        File::where('status', '!=', 0)->update(['status'=>0]);
        return redirect()->route('file.index');
    }
}
