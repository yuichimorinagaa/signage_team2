<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function index()
    {
        $files = File::all();
        return view('test.index', compact('files'));
    }

    public function upload(Request $request)
    {
        // アップロードされたファイルのインスタンスを取得
        $file = $request->file('image');

        // ファイルの保存先ディレクトリパスを定義（storage/app/public以下に保存する例）
        $filePath = $file->store('public');

        // ファイルパスからstorageディレクトリ部分を削除
        $filePath = str_replace('public/', '', $filePath);

        // データベースにファイルパスを保存
        $fileModel = new File();
        $fileModel->file_path = $filePath;
        $fileModel->save();


        // リダイレクトやその他の処理を追加する場合はここに記述

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }


}
