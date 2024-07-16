<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <title>Document</title>
    <style>
        .login_logo{
            display:flex;
            justify-content:center;
            font-size:50px;
            margin-bottom:10px;
        }
        .btn{
            width:100%;
            margin:5px;
        }
        input{
            margin:5px;
        }
        .btn:hover{
            background-color:#007bff;
        }
        .btn-secondary:active{
            transform:translateY(1px);

        }
        a{
            width:100%;
            display:flex;
            justify-content: center;
        }
        .container{
            width:348px;
            padding-top:100px;

        }
        body{
            background-color:#F0F5F9;
        }
        .alert-success{
            text-align:center;
        }
    </style>
</head>
<body>
<div class="container">
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <h1 class="login_logo">Login</h1>
    <form action="{{route('user.login')}}" method="post">
        @error('email')
        <div>{{$message}}</div>
        @enderror
        @csrf
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="text" id="email" name="email" class="form-control" placeholder="メールアドレスを入力してください">
        </div>
        @error('password')
        <div>{{$message}}</div>
        @enderror
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="パスワードを入力してください">
        </div>
        <button type="submit" class="btn btn-secondary">ログイン</button>
    </form>
    <a href="{{route('register.index')}}">新規登録はこちら</a>

</div>
</body>
</html>
