<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\File;

class FileController extends Controller
{
    public function store(Request $request)
    {
        // ファイルがアップロードされているか確認
        if ($request->hasFile('image')) {
            // ファイルを保存し、パスを取得
            $filePath = $request->file('image')->store('public/image');

            // ファイルパスをモデルに保存
            $file = new File;
            $file->file_path = str_replace('public/image/', '', $filePath);
            $file->save();

            // 成功した場合のリダイレクト
            return redirect()->route('file.index')->with('success', 'ファイルが正常にアップロードされました。');
        } else {
            // ファイルがアップロードされなかった場合のエラーメッセージを返す
            return redirect()->back()->with('error', 'ファイルを選択してください。');
        }
    }

    public function index()
    {
        // データベースからすべてのファイルを取得してビューに渡す
        $files = File::all();
        return view('user.file');
    }
}
