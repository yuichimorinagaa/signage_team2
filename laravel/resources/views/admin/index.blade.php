<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザー一覧</title>
    <!-- BootstrapのCSS読み込み -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- FontAwesomeの読み込み -->
    <link href="https://use.fontawesome.com/releases/v6.5.2/css/all.css" rel="stylesheet">
</head>
<style>
    body {
        background-color: #F0F5F9;
    }
    header {
        height: 45px;
        width: 100%;
        background-color: rgba(34, 49, 52, 0.9);
    }
    header p {
        color: white;
        font-size: 30px;
        font-family: "Noto Serif", sans-serif;
        font-weight: bold;
        margin-left: 5px;
    }
    .header-left {
        float: left;
    }
    .header-right {
        float: right;
        display: flex;
    }
    .logout{
        height: 45px;
        margin: 0;
        background-color: rgba(255, 255, 255, 0.3);
        transition: all 0.5s;
        border: none;
    }
    .table-container {
        margin: 20px;
    }
    .top-container{
        display:flex;
        justify-content: space-between;
        padding:10px;
    }
    .top-container a {
        margin-right: 10px;
        text-decoration: none;
        color: #007bff; /* Bootstrap のデフォルトリンク色 */
        font-size: 1rem; /* フォントサイズを調整 */
    }
    .top-container a.active {
        font-weight: bold;
        text-decoration: underline;
    }
    .top-container .btn-link {
        color: #007bff;
        font-size: 1rem;
    }
    .top-container .btn-link.active {
        font-weight: bold;
        text-decoration: underline;
    }

</style>
<header>
    <div class="header-left">
        <p>Admin</p>
    </div>
    <div class="header-right">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger logout">
                <i class="fa-solid fa-sign-out-alt"></i> ログアウト
            </button>
        </form>
    </div>
</header>
<body>
<div class="table-container">

    <div class="top-container">
        <div>
            <a href="{{ route('admin.index', ['sort' => 'created_asc']) }}" class="btn btn-link {{ $sort == 'created_asc' ? 'active' : '' }}">登録順（昇順）</a>
            <a href="{{ route('admin.index', ['sort' => 'created_desc']) }}" class="btn btn-link {{ $sort == 'created_desc' ? 'active' : '' }}">登録順（降順）</a>
            <a href="{{ route('admin.index', ['sort' => 'email_asc']) }}" class="btn btn-link {{ $sort == 'email_asc' ? 'active' : '' }}">メールアドレス（昇順）</a>
            <a href="{{ route('admin.index', ['sort' => 'email_desc']) }}" class="btn btn-link {{ $sort == 'email_desc' ? 'active' : '' }}">メールアドレス（降順）</a>
        </div>
        <button type="button" data-toggle="modal" data-target="#imageModal" class="btn btn-outline-danger delete-btn">
            画像を削除
        </button>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
        <tr>
            <th scope="col">ユーザー</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->email}}</td>
                <td>
                    <form action="{{route('admin.delete',['id'=>$user->id])}}" method="post" style="display:inline;">
                        @method('delete')
                        @csrf
                        <button type="button" data-toggle="modal" data-target="#deleteModal{{$user->id}}" class="btn btn-outline-danger user-delete">
                            削除
                        </button>

                        <!-- 削除確認モーダル -->
                        <div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$user->id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{$user->id}}">削除確認</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        本当にこのユーザーを削除しますか？
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                        <button type="submit" class="btn btn-danger">削除する</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <!-- ページネーションリンク -->
    <div class="pagination-link">
        {{$users->links('pagination::bootstrap-4')}}
    </div>
</div>



<!-- すべての画像を表示するモーダル -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">アップロードされた画像</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach($users as $user)
                    @foreach($user->files as $file)
                        <div>
                            <img src="{{ url('storage/image/' . $file->file_path) }}" alt="User Image" style="max-width: 100%;">
                            <form action="{{route('admin.deleteFile', ['id' => $file->id])}}" method="post" style="display:inline;">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger mt-2">削除</button>
                            </form>
                        </div>
                    @endforeach
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>

<!-- BootstrapおよびjQueryのJS読み込み -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
