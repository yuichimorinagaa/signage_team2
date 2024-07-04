<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class FileController extends Controller
{
    public function store(FileRequest $request)
    {
        // バリデーション

            // ファイルを保存し、パスを取得
            $request->validated();

            // ファイルを保存し、パスを取得

            $filePath = $request->file('file')->store('public/image');

            // ファイルパスをモデルに保存
            $file = new File;
            $file->file_path = str_replace('public/image/', '', $filePath);
            $file->user_id = Auth::id();
            $file->save();

            // 成功した場合のリダイレクト
            return redirect()->route('file.index')->with('success', 'ファイルが正常にアップロードされました。');

    }

    public function index()
    {
        // データベースからすべてのファイルを取得してビューに渡す
        $files = File::all();

        return view('user.file', compact('files'));
    }

    public function selectFiles(Request $request)
    {
        $selectedFiles = $request->input('selected_files', []);
        $request->session()->put('selected_files', $selectedFiles);

        return redirect()->route('file.select')->with('success', 'ファイルが選択されました。');
    }

    public function statusChange(Request $request)
    {
        $selectedFiles = $request->input('selected_files', '');

        // 選択されたファイルIDを配列に変換
        $selectedFilesArray = explode(',', $selectedFiles);

        if (!empty($selectedFilesArray)) {
            // ステータスを1に更新
            File::whereIn('id', $selectedFilesArray)->update(['status' => 1]);
        }

        // 更新後のファイル情報を取得
        $files = File::whereIn('id', $selectedFilesArray)->get();

        // ビューにファイル情報を渡す
        return view('user.preview', compact('files'));
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

    }}
