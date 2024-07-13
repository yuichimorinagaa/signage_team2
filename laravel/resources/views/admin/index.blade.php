<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .user{
            border-bottom: solid;
        }
        button {
            margin: 5px;
        }
        .user-address{
            font-size: 30px;
        }
    </style>
</head>
<body>
<h1>管理者画面</h1>
<h3>ユーザー一覧</h3>
@foreach($users as $user)
    <div class="user">
        <p class="user-address">{{$user->email}}</p>
        <form action="{{route('admin.delete',['id'=>$user->id])}}" method="post">
            @method('delete')
            @csrf
            <button type="button" data-toggle="modal" data-target="#deleteModal{{$user->id}}">
                ユーザーを削除
            </button>

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
                            <form action="{{route('admin.delete',['id'=>$user->id])}}" method="post" style="display:inline;">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">削除する</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </form>
        <button type="button" data-toggle="modal" data-target="#imageModal{{$user->id}}">
            画像を削除
        </button>

        <div class="modal fade" id="imageModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel{{$user->id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel{{$user->id}}">アップロードされた画像</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @foreach($user->files as $file)
                            <div>
                                <img src="{{ url('storage/image/' . $file->file_path) }}" alt="User Image" style="max-width: 100%;">
                                <form action="{{route('admin.deleteFile', ['id' => $file->id])}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger mt-2">削除</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
