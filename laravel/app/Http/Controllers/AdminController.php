<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function adminShow(Request $request)
    {
        // リクエストからソート順を取得。デフォルトは 'default'。
        $sort = $request->input('sort', 'default');

        // クエリビルダーを初期化
        $query = User::query();

        // ソート条件に応じてクエリを構築
        if ($sort == 'email_asc') {
            // メールアドレスで昇順にソート
            $query->orderBy('email', 'asc');
        } elseif ($sort == 'email_desc') {
            // メールアドレスで降順にソート
            $query->orderBy('email', 'desc');
        } elseif ($sort == 'created_asc') {
            // 登録日時で昇順にソート
            $query->orderBy('created_at', 'asc');
        } elseif ($sort == 'created_desc') {
            // 登録日時で降順にソート
            $query->orderBy('created_at', 'desc');
        } else {
            // デフォルトは登録順（最新の登録が最初）
            $query->orderBy('created_at', 'desc');
        }

        // データの取得とページネーションの適用
        $users = $query->paginate(10);

        // ビューにデータを渡す
        return view('admin.index', compact('users', 'sort'));
    }

    public function delete(Request $request)
    {
        $user = User::find($request['id']);
        if ($user && $user->id == $request['id']) {
            $user->delete();
            return redirect()->route('admin.index');
        }

        return redirect()->route('admin.index')->withErrors('User not found');
    }

    public function deleteFile($id)
    {
        $file = File::find($id);
        if ($file) {
            Storage::delete($file->file_path);
            $file->delete();
        }
        return redirect()->route('admin.index');
    }

    public function select()
    {
        return view('admin.select');
    }
}
