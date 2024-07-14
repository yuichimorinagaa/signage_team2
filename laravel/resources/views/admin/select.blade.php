<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- BootstrapのCSS読み込み -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <title>Document</title>
</head>
<style>
    body, html {
        height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width:500px;
    }
    .container form {
        width: 100%;
        max-width: 400px;
    }
    button {
        margin-bottom: 30px;
        width: 100%;

        height:80px;
        font-size:1.5em !important;

    }
</style>
<body>
<div class="container">
    <form action="{{route('file.index')}}" class="form-group">
        <button class="btn btn-primary">アップロード画面</button>
    </form>
    <form action="{{route('admin.index')}}" class="form-group">
        <button class="btn btn-primary">管理者画面</button>
    </form>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">ログアウト</button>
    </form>
</div>
</body>
</html>
