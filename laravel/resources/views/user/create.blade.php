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
<form action="{{route('user.store')}}">
    <label for="user">ユーザー名</label>
    <input type="text" id="name" name="name">
    <label for="email">メールアドレス</label>
    <input type="text" name="email" id="email00">
    <label for="password">パスワード</label>
    <input type="text" id="password" name="password">
    <label for="code">招待コード</label>
    <input type="text" id="code" name="code">
    <button>送信</button>

</form>
</body>
</html>
