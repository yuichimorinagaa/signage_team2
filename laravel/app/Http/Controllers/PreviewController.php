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
        $selectedFiles = $request->input('files', []);
        if(!empty($selectedFiles)){
            File::whereIn('id', $selectedFiles)->update(['status' => 1]);
        }
        File::whereNotIn('id', $selectedFiles)->update(['status' => 0]);
        return redirect()->route('preview.index')->with('success', '更新しました');
    }


    public function back(){
        File::where('status', '!=', 0)->update(['status'=>0]);
        return redirect()->route('file.index');
    }
}
