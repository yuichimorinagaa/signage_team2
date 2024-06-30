<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class FileController extends Controller
{
    public function store(Request $request)
    {
        // ファイルがアップロードされているか確認
        //if ($request->hasFile('file')) {
            // ファイルを保存し、パスを取得

            $request->validate([
                'file' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $filePath = $request->file('file')->store('public/image');

            // ファイルパスをモデルに保存
            $file = new File;
            $file->file_path = str_replace('public/image/', '', $filePath);
            $file->user_id = Auth::id();
            $file->save();

            // 成功した場合のリダイレクト
            return redirect()->route('file.index')->with('success', 'ファイルが正常にアップロードされました。');
        //} else {
            // ファイルがアップロードされなかった場合のエラーメッセージを返す
            //return redirect()->back()->with('error', 'ファイルを選択してください。');
        //}
    }

    public function index()
    {
        // データベースからすべてのファイルを取得してビューに渡す
        $files = File::all();

        return view('user.file', compact('files'));
    }


    public function delete($id)
    {


        $file = File::find($id);

        $userId = Auth::id();
        // ログインユーザーが画像の所有者かどうかを確認します
        if ($file->user_id !== $userId) {
            return redirect()->back()->with('error', 'この画像は削除できません。');

        }

        Storage::delete('storage/image/'. $file->file_path);

        $file->delete();

        return redirect()->route('file.index')->with('success', '画像を削除しました。');
    }
}
