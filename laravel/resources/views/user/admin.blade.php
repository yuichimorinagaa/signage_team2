<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>管理者画面</h1>
<h3>ユーザー一覧</h3>
@foreach($users as $user)
    <p>
    {{$user->email}}
    <form action="{{route('user.delete',['id'=>$user->id])}}" method="post">
        @method('delete')
        @csrf
        <button>削除する</button>
    </form>
@endforeach
</body>
</html>
