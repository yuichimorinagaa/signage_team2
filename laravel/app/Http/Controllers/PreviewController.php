<?php

namespace App\Http\Controllers;


use App\Models\File;
use Illuminate\Http\Request;

class PreviewController extends Controller
{
    public function index(){
        //$files = File::All();
        $files = File::where('status', 1)->get();
        return view('user.preview', compact('files'));
    }

    public function update(Request $request){
        $selectedFiles = $request->input('files', []);
        if(!empty($selectedFiles)){
            File::whereIn('id', $selectedFiles)->update(['status' => File::STATUS_SELECTED]);
        }
        File::whereNotIn('id', $selectedFiles)->update(['status' => File::STATUS_NOT_SELECTED]);
        return redirect()->route('preview.index')->with('success', '更新しました');
    }


    public function back(){
        File::where('status', '!=', File::STATUS_NOT_SELECTED)->update(['status'=>File::STATUS_NOT_SELECTED]);
        return redirect()->route('file.index');
    }
}
