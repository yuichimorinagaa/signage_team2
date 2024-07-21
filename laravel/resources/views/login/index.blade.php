<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- BootstrapのCSS読み込み -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- FontAwesomeの読み込み -->
    <link href="https://use.fontawesome.com/releases/v6.5.2/css/all.css" rel="stylesheet">
    <!-- jqueryの読み込み　-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
        .password-wrapper {
            position: relative;
        }
        .password-wrapper input {
            padding-right: 30px; /* アイコンの幅分のスペースを確保 */
        }
        .password-wrapper .fa-eye-slash,
        .password-wrapper .fa-eye {
            position: absolute;
            right: 10px;
            top:75%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }    </style>
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
        <div class="form-group password-wrapper">
            <label for="password">パスワード(8文字以上)</label>
            <input class="form-control" type="password" id="password" name="password" placeholder="パスワードを8文字以上で入力してください">
            <span id="view">
                <i class="fa-regular fa-eye-slash"></i>
            </span>
        </div>
        <button type="submit" class="btn btn-secondary">ログイン</button>
    </form>
    <a href="{{route('register.index')}}">新規登録はこちら</a>

</div>
<script>
    //  id="view"を取得
    let viewicon = document.getElementById('view');

    //  id="password"を取得
    let inputtype = document.getElementById('password');

    //  id="view"クリック時の処理を設定
    $('#view').on('click', function () {

        //  passwordからtextへ
        if(inputtype.type === 'password'){
            inputtype.type = 'text';
            viewicon.innerHTML = '<i class="far fa-eye"></i>';

            //  textからpasswordへ
        } else {
            inputtype.type = 'password';
            viewicon.innerHTML = '<i class="far fa-eye-slash"></i>';
        }
    });

</script>
</body>
</html>
