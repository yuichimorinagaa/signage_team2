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
        body{
            background-color:#F0F5F9;
        }
        .signup{
            font-size:50px;
            display:flex;
            justify-content:center;
        }
        .btn{
            transition:all 0.1s ease;
            width:100%;
            margin:5px 0;
        }
        .btn:hover{
            background-color:#007bff;
        }
        .btn-secondary:active{
            transform:translateY(1px);

        }
        .container{
            width:348px;
            padding-top:100px;

        }
        input{
            margin:5px 0;
        }
        a{
            display:flex;
            justify-content: center;
        }

    </style>
</head>
<body>

<div class="container">
    <h1 class="signup">Sign Up</h1>
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
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input class="form-control" type="text" name="email" id="email" placeholder="メールアドレスを入力してください">

        </div>
        <div class="form-group">
            <label for="password">パスワード(8文字以上)</label>
            <input class="form-control" type="password" id="password" name="password" placeholder="パスワードを8文字以上で入力してください">
        </div>
        <div class="form-group">
            <label for="invitation_code">招待コード</label>
            <input class="form-control" type="text" id="invitation_code" name="invitation_code" placeholder="招待コードを入力してください">
        </div>
            <button type="submit" class="btn btn-secondary" >新規登録</button>
    </form>
    <a href="{{route('login.index')}}">ログインはこちら</a>
</div>

</body>
</html>
