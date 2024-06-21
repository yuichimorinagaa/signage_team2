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
<h1>ログイン画面</h1>
<form action="">
    <label for="name">ユーザー名</label>
    <input type="text" id="name" name="name">
    <label for="email">メールアドレス</label>
    <input type="text" id="email" name="email">
    <label for="password">パスワード</label>
    <input type="text" id="password" name="password">
    <button>ログイン</button>
</form>
<a href="{{route('user.create')}}">新規登録</a>
</body>
</html>
