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
<h1>新規登録</h1>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('login.store')}}" method="post">
    @csrf
    <label for="email">メールアドレス</label>
    <input type="text" name="email" id="email">
    <label for="password">パスワード</label>
    <input type="password" id="password" name="password">
    <label for="invitation_code">招待コード</label>
    <input type="text" id="invitation_code" name="invitation_code">
    <button type="submit">送信</button>
</form>
<a href="{{route('login.index')}}">ログイン画面へ戻る</a>
</body>
</html>
